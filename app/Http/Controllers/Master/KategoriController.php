<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\KategoriModels;

use Datatables;
use Redirect, Response;
use DateTime;
use DB;

class KategoriController extends Controller
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
        return view('office.kategori.master-kategori', compact('order_baru','pembayaran','user_baru'));
    }

    public function list_data_hdr(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'nama',
            3 => 'nama',
            4 => 'keterangan',
            5 => 'action'
        );

        $totalData = DB::table('tmst_kategori')
            ->where('status_hapus', '=', 0)
            ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = DB::table('tmst_kategori')
                ->offset($start)
                ->limit($limit)
                ->where('status_hapus', '=', 0)
                ->orderBy('nama')
                ->get();
        } else {
            $search = $request->input('search.value');

            $posts =  DB::table('tmst_kategori')
                ->offset($start)
                ->limit($limit)
                // ->where([['status_hapus', '=', 0], ['kode', 'LIKE', "%{$search}%"]])
                ->Where([['status_hapus', '=', 0], ['nama', 'LIKE', "%{$search}%"]])
                ->orderBy('nama')
                ->get();

            $totalFiltered = DB::table('tmst_kategori')
                // ->where([['status_hapus', '=', 0], ['kode', 'LIKE', "%{$search}%"]])
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
                $nestedData['peruntukan'] = $post->peruntukan;
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

    public function store(Request $request)
    {
        $grup_kategori    = KategoriModels::where('nama', $request->nama)->first();

        if ($grup_kategori === NULL) {            
            $data_hdr['nama']           = $request->nama;
            $data_hdr['peruntukan']     = $request->peruntukan;
            $data_hdr['keterangan']     = $request->keterangan;
            $data_hdr['status_hapus']   = '0';
            $data_hdr['user_at']       = 'system';

            $data_save_hdr = KategoriModels::create($data_hdr);

            $msg = 'Data berhasil di simpan';
            return response()->json(['success' => true, 'message' => $msg]);
        } else {
            $msg = 'Kode Barang Sudah Terdaftar';
            return response()->json(['warning' => true, 'message' => $msg]);
        }    
    }

    public function update(Request $request)
    {
        $data = [
            'nama'          => $request->nama,
            'peruntukan'    => $request->peruntukan,
            'keterangan'    => $request->keterangan,
            'user_at'      => 'system'
        ];

        KategoriModels::where('id', $request->sysid)->update($data);
        $msg = 'Data berhasil di ubah';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function destroy(Request $request)
    {
        $data = [
            'status_hapus'  => 1,
            'user_at'      => 'system'
        ];

        KategoriModels::where('id', $request->id)->update($data);
        $msg = 'Data berhasil di hapus';
        return response()->json(['success' => true, 'message' => $msg]);
    }
}
