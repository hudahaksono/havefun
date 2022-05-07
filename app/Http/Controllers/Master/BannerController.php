<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use App\Models\BannerModels;
use App\Helpers\Helper;
use Redirect, Response, DB;

class BannerController extends Controller
{
    public function index()
    {
        // date_default_timezone_set('Asia/Jakarta');
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
        // dd($user_baru);
        return view('office.banner.banner', compact('order_baru','pembayaran','user_baru'));
    }

    public function list_data_hdr(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'nama',
            3 => 'file_name',
            4 => 'keterangan'
        );

        $totalData = DB::table('tmst_banner')
            ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = DB::table('tmst_banner')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $posts =  DB::table('tmst_banner')
                ->offset($start)
                ->limit($limit)
                ->where([['nama', 'LIKE', "%{$search}%"]])
                ->Where([['keterangan', 'LIKE', "%{$search}%"]])
                ->Where([['file_name', 'LIKE', "%{$search}%"]])
                ->orderBy($order,$dir)
                ->get();

            $totalFiltered = DB::table('tmst_banner')
                ->where([['nama', 'LIKE', "%{$search}%"]])
                ->Where([['keterangan', 'LIKE', "%{$search}%"]])
                ->Where([['file_name', 'LIKE', "%{$search}%"]])
                ->count();
        }

        $data = array();
        $i = $start + 1;
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['id'] = $post->id;
                $nestedData['DT_RowIndex'] = $i;
                $nestedData['nama'] = $post->nama;
                $nestedData['keterangan'] = $post->keterangan;
                $nestedData['file_name'] = $post->file_name;
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
                $resorce->move(\base_path() . "/public/banner", $filenameSimpan);
            }
            $fileMultiSimpan = Helper::left($fileMulti, strlen($fileMulti) - 1);

            $bpp_dtl_attach                     = new BannerModels();

            $bpp_dtl_attach->nama               = $request->input('nama');
            $bpp_dtl_attach->file_name          = $filenameSimpan;
            $bpp_dtl_attach->keterangan         = $request->input('keterangan');
            $bpp_dtl_attach->user_at            = $request->input('sess_nama');

            $bpp_dtl_attach->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Please select file attachment first.']);
        }
    }

    public function update(Request $request)
    {
        $fileMulti = '';
        if ($request->file('filename')) {
            foreach ($request->file('filename') as $file) {
                $resorce            = $file;
                $filenameWithExt    = $file->getClientOriginalName();
                $filename           = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension          = $file->getClientOriginalExtension();
                $filenameSimpan     = str_replace(" ", "", $filename) . "_" . time() . "." . $extension;
                $fileMulti = $filenameSimpan . ',' . $fileMulti;
                $resorce->move(\base_path() . "/public/banner", $filenameSimpan);
            }
            $fileMultiSimpan = Helper::left($fileMulti, strlen($fileMulti) - 1);

            $databarang = DB::table('tmst_banner')->where('id', $request->sysid)->first();
            $fildelete = $databarang->file_name;
            $pathdelete = base_path() . "/public/banner";
            foreach (explode(',', $fildelete) as $row) {
                File::delete($pathdelete . '/' . $row);
            }

            $data = [
                'nama'          => $request->input('nama'),
                'keterangan'    => $request->input('keterangan'),
                'file_name'          => $filenameSimpan,
                'user_at'      => $request->input('sess_nama')
            ];
        } else {
            $data = [
                'nama'          => $request->input('nama'),
                'keterangan'    => $request->input('keterangan'),
                'user_at'      => $request->input('sess_nama')
            ];
        }

        BannerModels::where('id', $request->sysid)->update($data);
        $msg = 'Data berhasil di ubah';
        return response()->json(['success' => true]);
    }

    public function destroy(Request $request)
    {
        $databarang = DB::table('tmst_banner')->where('id', $request->id)->first();
        $fildelete = $databarang->file_name;
        $pathdelete = base_path() . "/public/banner";
        foreach (explode(',', $fildelete) as $row) {
            File::delete($pathdelete . '/' . $row);
        }
        BannerModels::where('id', $request->id)->delete();
        $msg = 'Data berhasil di hapus';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function view_filename($filename)
    {
        // $path = storage_path('app/public/Procurement/BPP-REPORT/' . $request->file_name);
        $path = base_path() . "/public/banner/" . $filename;
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
