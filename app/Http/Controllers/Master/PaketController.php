<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaketModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Helpers\Helper;

use Datatables;
use Redirect, Response;
use DateTime;
use DB;

class PaketController extends Controller
{
    public function index()
    {
        $date_now = now();
        $date = date("Y-m-d H:i:s", strtotime($date_now . ' -10 hour'));
        // dd($date);
        $order_baru = DB::table('ttrx_order')
                        ->select(DB::raw('no_order,timediff("'.$date_now.'",created_at) as selisih '))
                        ->where('status',1)
                        ->where('created_at','>=',$date)
                        ->get();
        $pembayaran = DB::table('ttrx_payment')
                        ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
                        ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.total_payment', 'ttrx_actual_payment.flag_dp', DB::raw('timediff("'.$date_now.'",ttrx_actual_payment.created_at) as selisih'))
                        ->where('ttrx_actual_payment.created_at','>=',$date)
                        ->get();
        $user_baru = DB::table('mst_users')
                        ->select(DB::raw('nama,timediff("'.$date_now.'",created_at) as selisih '))
                        ->where('created_at','>=',$date)
                        ->get();
        return view('office.paket.master-paket', compact('order_baru','pembayaran','user_baru'));
    }

    public function list_data_hdr(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'nama',
            3 => 'keterangan',
            4 => 'action'
        );

        $totalData = DB::table('qview_mst_paket')
            ->where('status_hapus', '=', 0)
            ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = DB::table('qview_mst_paket')
                ->offset($start)
                ->limit($limit)
                ->where('status_hapus', '=', 0)
                ->orderBy('nama')
                ->get();
        } else {
            $search = $request->input('search.value');

            $posts =  DB::table('qview_mst_paket')
                ->offset($start)
                ->limit($limit)
                ->Where([['status_hapus', '=', 0], ['nama', 'LIKE', "%{$search}%"]])
                ->orderBy('nama')
                ->get();

            $totalFiltered = DB::table('qview_mst_paket')
                ->Where([['status_hapus', '=', 0], ['nama', 'LIKE', "%{$search}%"]])
                ->count();
        }

        $data = array();
        $i = $start + 1;
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['id'] = $post->id;
                $nestedData['DT_RowIndex'] = $i;
                // $nestedData['kode'] = $post->kode;
                $nestedData['nama'] = $post->nama;
                $nestedData['id_kategori'] = $post->id_kategori;
                if($post->id_kategori==1){
                    $nestedData['nama_kategori'] = 'Paket Lite';
                }elseif($post->id_kategori==2){
                    $nestedData['nama_kategori'] = 'Paket Medium';
                }else{
                    $nestedData['nama_kategori'] = 'Paket Stepa';
                }
                
                $nestedData['file_name'] = $post->file_name;
                $nestedData['harga'] = $post->harga;
                $nestedData['keterangan'] = $post->keterangan;
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

    public function list_data_dtl(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'nama',
            3 => 'keterangan',
            4 => 'action'
        );
        $id_hdr = $request->id_hdr;
        $totalData = DB::table('qview_mst_paket_product')
            ->where('id_hdr', '=', $id_hdr)
            ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = DB::table('qview_mst_paket_product')
                ->offset($start)
                ->limit($limit)
                ->where('id_hdr', '=', $id_hdr)
                ->orderBy('nama')
                ->get();
        } else {
            $search = $request->input('search.value');

            $posts =  DB::table('qview_mst_paket_product')
                ->offset($start)
                ->limit($limit)
                ->Where([['id_hdr', '=', $id_hdr], ['nama', 'LIKE', "%{$search}%"]])
                ->orderBy('nama')
                ->get();

            $totalFiltered = DB::table('qview_mst_paket_product')
                ->Where([['id_hdr', '=', $id_hdr], ['nama', 'LIKE', "%{$search}%"]])
                ->count();
        }

        $data = array();
        $i = $start + 1;
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['id'] = $post->id;
                $nestedData['DT_RowIndex'] = $i;
                // $nestedData['kode'] = $post->kode;
                $nestedData['nama'] = $post->nama;
                $nestedData['id_product'] = $post->id_product;
                $nestedData['action'] = "<a href='javascript:void(0)' id='delete_data_dtl' data-toggle='tooltip' title='Delete' data-id='$post->id' data-original-title='' class='Delete btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i> &nbsp; Hapus </a>";
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

    public function store(Request $request)
    {
        // $grup_kategori    = PaketModels::where('nama', $request->nama)->first();

        // if ($grup_kategori === NULL) {
        //     $data_hdr['nama']           = $request->nama;
        //     $data_hdr['keterangan']     = $request->keterangan;
        //     $data_hdr['status_hapus']   = '0';
        //     $data_hdr['created_at']     = now();

        //     PaketModels::create($data_hdr);

        //     $msg = 'Data berhasil di simpan';
        //     return response()->json(['success' => true, 'message' => $msg]);
        // } else {
        //     $msg = 'Kode Barang Sudah Terdaftar';
        //     return response()->json(['warning' => true, 'message' => $msg]);
        // }
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

            // $bpp_dtl_attach                     = new PaketModels();

            $data_hdr['id_kategori']        = $request->input('kategori');
            $data_hdr['nama']               = $request->input('nama');
            $data_hdr['harga']              = $request->input('harga');
            $data_hdr['file_name']          = $filenameSimpan;
            $data_hdr['file_name_multi']    = $fileMultiSimpan;
            $data_hdr['keterangan']            = $request->input('keterangan');
            $data_hdr['status_hapus']          = 0;
            // $bpp_dtl_attach->user_at         = $request->session()->get('sess_nama');

            $data_save_hdr                      = PaketModels::create($data_hdr);

            return response()->json(['success' => true, 'id_hdr' => $data_save_hdr->id]);
        } else {
            return response()->json(['error' => 'Please select file attachment first.']);
        }
    }

    public function store_dtl(Request $request)
    {
        $id_hdr = $request->id_hdr;
        $id_barang = $request->barang_id;
        $data_count = DB::table('tmst_paket_product')
                ->where([['id_hdr','=',$id_hdr],['id_product','=',$id_barang]])
                ->count();
        if($data_count>0){
            $msg = 'Barang sudah ada!';
            return response()->json(['success' => false, 'message' => $msg]);
        }else{
            DB::insert("INSERT INTO tmst_paket_product (id_hdr,id_product) VALUES (".$id_hdr.",".$id_barang.")");
            $msg = 'Data berhasil di simpan';
            return response()->json(['success' => true, 'message' => $msg]);
        }
    }

    public function update(Request $request)
    {
        $data = [
            'nama'          => $request->nama,
            'harga'          => $request->harga,
            'id_kategori'          => $request->kategori,
            'keterangan'    => $request->keterangan,
        ];

        PaketModels::where('id', $request->sysid)->update($data);
        $msg = 'Data berhasil di ubah';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function destroy(Request $request)
    {
        $data = [
            'status_hapus'  => 1,
        ];

        PaketModels::where('id', $request->id)->update($data);
        $delete = DB::table('tmst_paket_product')
                    ->where('id_hdr',$request->id)
                    ->delete();
        $msg = 'Data berhasil di hapus';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function destroy_dtl(Request $request)
    {
        $id = $request->id;
        $delete = DB::table('tmst_paket_product')->where('id',$id)->delete();
        $msg = 'Data berhasil di hapus';
        return response()->json(['success' => true, 'message' => $msg]);
    }
}
