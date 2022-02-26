<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\BarangModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Helpers\Helper;

use Datatables;
use Redirect, Response;
use DateTime;
use DB;

class ProductController extends Controller
{
    public function index()
    {

        return view('office.product.master-product');
    }

    public function list_data_hdr(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'ukuran',
            3 => 'keterangan',
            4 => 'action'
        );

        $totalData = DB::table('qview_mst_barang')
            ->where('status_hapus', '=', 0)
            ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        // $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = DB::table('qview_mst_barang')
                ->offset($start)
                ->limit($limit)
                ->where('status_hapus', '=', 0)
                ->orderBy('nama')
                ->get();
        } else {
            $search = $request->input('search.value');

            $posts =  DB::table('qview_mst_barang')
                ->offset($start)
                ->limit($limit)
                ->where([['status_hapus', '=', 0], ['nama', 'LIKE', "%{$search}%"]])
                ->Where([['status_hapus', '=', 0], ['nama_kategori', 'LIKE', "%{$search}%"]])
                ->orderBy('nama')
                ->get();

            $totalFiltered = DB::table('qview_mst_barang')
                ->where([['status_hapus', '=', 0], ['nama', 'LIKE', "%{$search}%"]])
                ->Where([['status_hapus', '=', 0], ['nama_kategori', 'LIKE', "%{$search}%"]])
                ->count();
        }

        $data = array();
        $i = $start + 1;
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['id'] = $post->id;
                $nestedData['DT_RowIndex'] = $i;
                $nestedData['nama'] = $post->nama;
                $nestedData['satuan'] = $post->satuan;
                $nestedData['id_kategori'] = $post->id_kategori;
                $nestedData['nama_kategori'] = $post->nama_kategori;
                $nestedData['id_paket'] = $post->id_paket;
                $nestedData['nama_paket'] = $post->nama_paket;
                $nestedData['id_ukuran'] = 0;
                $nestedData['ukuran'] = '';
                $nestedData['keterangan'] = $post->keterangan;
                $nestedData['file_name'] = $post->file_name;
                $nestedData['harga'] = $post->harga;
                $nestedData['action'] = "&emsp;<a href='javascript:void(0)' id='edit_data_hdr' data-toggle='tooltip' title='Edit' data-id='$post->id' data-original-title='' class='Edit btn btn-warning btn-sm'><i class='fas fa-pencil-alt'></i> &nbsp; Edit </a>
                                        <a href='javascript:void(0)' id='delete_data_hdr' data-toggle='tooltip' title='Delete' data-id='$post->id' data-original-title='' class='Delete btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i> &nbsp; Hapus </a>";
                $data[] = $nestedData;
                $i++;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function list_data_paket(Request $request)
    {
        $data = DB::table('tmst_paket')
            ->where('status_hapus', '=', 0)
            ->get();
        return response()->json($data);
    }

    public function list_data_kategori(Request $request)
    {
        $data = DB::table('tmst_kategori')
            ->where('status_hapus', '=', 0)
            ->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        // var_dump ($request->file('filename'));
        //    die();
        $fileMulti = '';
        if ($request->file('filename')) {
            foreach ($request->file('filename') as $file) {
                $resorce            = $file;
                $filenameWithExt    = $file->getClientOriginalName();
                $filename           = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension          = $file->getClientOriginalExtension();
                $filenameSimpan     = str_replace(" ", "", $filename) . "_" . time() . "." . $extension;
                $fileMulti = $filenameSimpan . ',' . $fileMulti;

                // $path = $file->storeAs("public/produk", $filenameSimpan);
                $resorce->move(\base_path() . "/public/produk", $filenameSimpan);
            }
            $fileMultiSimpan = Helper::left($fileMulti, strlen($fileMulti) - 1);

            $bpp_dtl_attach                     = new BarangModels();

            $bpp_dtl_attach->id_paket           = $request->input('paket');
            $bpp_dtl_attach->id_kategori        = $request->input('kategori');
            $bpp_dtl_attach->id_ukuran          = 0;
            $bpp_dtl_attach->nama               = $request->input('nama');
            $bpp_dtl_attach->satuan             = $request->input('satuan');
            $bpp_dtl_attach->harga             = $request->input('harga');
            $bpp_dtl_attach->file_name          = $filenameSimpan;
            $bpp_dtl_attach->file_name_multi    = $fileMultiSimpan;
            $bpp_dtl_attach->keterangan            = $request->input('keterangan');
            $bpp_dtl_attach->status_hapus          = 0;
            $bpp_dtl_attach->user_at         = $request->session()->get('sess_nama');

            $bpp_dtl_attach->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Please select file attachment first.']);
        }
    }

    public function update(Request $request, BarangModels $barangModels)
    {
        $fileMulti = '';
        if ($request->file('e_filename')) {
            foreach ($request->file('e_filename') as $file) {
                $resorce            = $file;
                $filenameWithExt    = $file->getClientOriginalName();
                $filename           = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension          = $file->getClientOriginalExtension();
                $filenameSimpan     = str_replace(" ", "", $filename) . "_" . time() . "." . $extension;
                $fileMulti = $filenameSimpan . ',' . $fileMulti;

                // $path = $file->storeAs("public/produk", $filenameSimpan);
                $resorce->move(\base_path() . "/public/produk", $filenameSimpan);
            }
            $fileMultiSimpan = Helper::left($fileMulti, strlen($fileMulti) - 1);

            $databarang = DB::table('tmst_product')->where('id', $request->e_sysid)->first();
            $fildelete = $databarang->file_name_multi;
            $pathdelete = base_path() . "/public/produk";
            foreach (explode(',', $fildelete) as $row) {
                File::delete($pathdelete . '/' . $row);
            }

            $data = [
                'nama'          => $request->input('e_nama'),
                'satuan'          => $request->input('e_satuan'),
                'id_kategori'          => $request->input('e_kategori'),
                'id_ukuran'          => 0,
                'keterangan'    => $request->input('e_keterangan'),
                'file_name'          => $filenameSimpan,
                'file_name_multi'          => $fileMultiSimpan,
                'user_at'      => $request->session()->get('sess_nama')
            ];
        } else {
            $data = [
                'nama'          => $request->input('e_nama'),
                'satuan'          => $request->input('e_satuan'),
                'id_kategori'          => $request->input('e_kategori'),
                'id_ukuran'          => 0,
                'keterangan'    => $request->input('e_keterangan'),
                'user_at'      => $request->session()->get('sess_nama')
            ];
        }

        BarangModels::where('id', $request->e_sysid)->update($data);
        $msg = 'Data berhasil di ubah';
        return response()->json(['success' => true]);
    }

    public function destroy(Request $request)
    {
        $data = [
            'status_hapus'  => 1,
            'user_at'      => $request->session()->get('sess_nama')
        ];

        BarangModels::where('id', $request->id)->update($data);
        $msg = 'Data berhasil di hapus';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function view_filename($filename)
    {
        // $path = storage_path('app/public/Procurement/BPP-REPORT/' . $request->file_name);
        $path = base_path() . "/public/produk/" . $filename;
        $path = str_replace(" ", "", $path);
        if (File::exists($path)) {
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        } else {
            return response()->json(['success' => false, 'flag' => $path]);
        }
    }
}
