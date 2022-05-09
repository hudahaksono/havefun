<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScheduleModels;

use Datatables;
use Redirect, Response;
use DateTime;
use DB;

class ScheduleController extends Controller
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
        return view('office.transaksi.tr-shcedule', compact('order_baru','pembayaran','user_baru'));
    }

    public function list_data_hdr(Request $request)
    {
    	$data = DB::table('ttrx_schedule')
    				// ->join('ttrx_order', 'ttrx_schedule.id_order', '=', 'ttrx_order.id')
    				// ->select('ttrx_schedule.*', 'ttrx_order.no_order')
    				->get();
        $listdata = array();
        foreach($data as $value){
            $parse['start'] = Date('Y-m-d', strtotime($value->tgl_dari));
            $parse['end'] = Date('Y-m-d', strtotime($value->tgl_sampai));
            $parse['title'] = $value->no_order.': '.$value->keterangan;
            // $parse['display'] = 'background';
            // $parse['color'] = '#ff9f89';
            $listdata[] = $parse;
        }
        $parse = [];
        foreach($data as $value){
            $parse['start'] = Date('Y-m-d', strtotime($value->tgl_dari));
            $parse['end'] = Date('Y-m-d', strtotime($value->tgl_sampai));
            // $parse['title'] = $value->no_order.': '.$value->keterangan;
            $parse['display'] = 'background';
            $parse['color'] = '#ff9f89';
            $listdata[] = $parse;
        }
        $parse = [];
        foreach($data as $value){
            $parse['start'] = Date('Y-m-d', strtotime($value->tgl_dari));
            $parse['end'] = Date('Y-m-d', strtotime($value->tgl_sampai));
            $parse['title'] = 'Lokasi : '.$value->tempat;
            $listdata[] = $parse;
        }
    	return response()->json($listdata);
    }

    public function list_data_order(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'no_order',
            3 => 'tgl_order',
            4 => 'action'
        );

        $totalData = DB::table('qview_order_hdr')
            // ->where('status', '!=', 1)
            ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $limit = 10;
        $start = 0;
        // $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = DB::table('qview_order_hdr')
                ->offset($start)
                ->limit($limit)
                // ->where('status', '!=', 1)
                ->orderBy('tgl_order')
                ->get();
        } else {
            $search = $request->input('search.value');

            $posts =  DB::table('qview_order_hdr')
                ->offset($start)
                ->limit($limit)
                // ->where([['status', '!=', 1],['no_order', 'LIKE', "%{$search}%"]])
                // ->Where([['status', '!=', 1],['nama', 'LIKE', "%{$search}%"]])
                ->orderBy('tgl_order')
                ->get();

            $totalFiltered = DB::table('qview_order_hdr')
                // ->where([['status', '!=', 1],['no_order', 'LIKE', "%{$search}%"]])
                // ->Where([['status', '!=', 1],['nama', 'LIKE', "%{$search}%"]])
                ->count();
        }
// dd($posts);
        $data = array();
        $i = $start + 1;
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['id'] = $post->no_order;
                $nestedData['DT_RowIndex'] = $i;
                $nestedData['no_order'] = $post->no_order;
                $nestedData['tgl_order'] = $post->tgl_order;
                $nestedData['id_user'] = $post->id_user;
                $nestedData['id_product'] = $post->id_product;
                $nestedData['nama'] = $post->nama;
                $nestedData['email'] = $post->email;
                $nestedData['no_tlp'] = $post->no_tlp;
                
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
        $data_hdr['no_order']       = $request->id_order;
        $data_hdr['tempat']         = $request->tempat;
        $data_hdr['tgl_dari']       = Date('Y-m-d', strtotime($request->tgl_dari));
        $data_hdr['tgl_sampai']     = Date('Y-m-d', strtotime($request->tgl_sampai));
        $data_hdr['keterangan']     = $request->keterangan;
        $data_hdr['status']         = '0';
        $data_hdr['user_at']        = 'system';

        $data_save_hdr = ScheduleModels::create($data_hdr);

        $msg = 'Data berhasil di simpan';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function update(Request $request)
    {
        $data = [
            'id_order'      => $request->id_order,
            'tempat'      => $request->tempat,
            'tgl_dari'      => $request->tgl_dari,
            'tgl_sampai'    => $request->tgl_sampai,
            'keterangan'    => $request->keterangan,
            'user_at'       => 'system'
        ];

        ScheduleModels::where('id', $request->sysid)->update($data);
        $msg = 'Data berhasil di ubah';
        return response()->json(['success' => true, 'message' => $msg]);
    }
}