<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModels;
use App\Models\PaymentModels;
use App\Models\PaymentActualModels;

use Datatables;
use Redirect, Response;
use DateTime;
use DB;

class PaymentController extends Controller
{
	public function index()
    {
        return view('office.transaksi.tr-payment');
    }

    public function list_data_hdr(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'no_order',
            3 => 'tgl_order',
            4 => 'action'
        );

        $totalData = DB::table('ttrx_payment')
                        ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
                        ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
                        ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'))
                        ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment')
                        ->where('status', '=', 0)
                        ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        // $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = DB::table('ttrx_payment')
                        ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
                        ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
                        ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'))
                        ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment')
                        ->offset($start)
                        ->limit($limit)
                        ->where('status', '=', 0)
                        ->get();
        } else {
            $search = $request->input('search.value');

            $posts =  DB::table('ttrx_payment')
                        ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
                        ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
                        ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'))
                        ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment')
                        ->offset($start)
                        ->limit($limit)
                        ->where([['status', '=', 0],['ttrx_payment.no_payment', 'LIKE', "%{$search}%"]])
                        ->Where([['status', '=', 0],['ttrx_payment.no_order', 'LIKE', "%{$search}%"]])
                        ->Where([['status', '=', 0],['mst_users.nama', 'LIKE', "%{$search}%"]])
                        ->orderBy('ttrx_payment.tgl_payment')
                        ->get();

            $totalFiltered = DB::table('ttrx_payment')
                        ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
                        ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
                        ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'))
                        ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment')
                        ->where([['status', '=', 0],['ttrx_payment.no_payment', 'LIKE', "%{$search}%"]])
                        ->Where([['status', '=', 0],['ttrx_payment.no_order', 'LIKE', "%{$search}%"]])
                        ->Where([['status', '=', 0],['mst_users.nama', 'LIKE', "%{$search}%"]])
                        ->count();
        }

        $data = array();
        $i = $start + 1;
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['id'] = $post->id;
                $nestedData['DT_RowIndex'] = $i;
                $nestedData['no_payment'] = $post->no_payment;
                $nestedData['tgl_payment'] = $post->tgl_payment;
                $nestedData['no_order'] = $post->no_order;
                $nestedData['total_payment'] = $post->total_payment;
                $nestedData['actual_payment'] = $post->actual_payment;
                $nestedData['os_payment'] = floatval($post->total_payment) - ($post->actual_payment);
                $nestedData['nama'] = $post->nama;
                
                $nestedData['action'] = "&emsp;<a href='javascript:void(0)' id='tindak_lanjut' data-toggle='tooltip' title='Tindak Lanjut' data-id='$post->id' data-original-title='' class='Edit btn btn-primary btn-sm'><i class='fa fa-location-arrow'></i> &nbsp; Payment </a>";
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
        $no_order               = $request->no_order;
        $id_payment             = $request->id_payment;
        $actual_payment_input   = $request->actual_payment;
        $data = DB::table('ttrx_payment')
                        ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
                        ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'))
                        ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.total_payment')
                        ->where('ttrx_payment.id', '=', $id_payment)
                        ->first();
        
        $total_payment = $data->total_payment;
        $os_payment = floatval($data->total_payment) - (floatval($actual_payment_input) + floatval($data->actual_payment));
        // dd(floatval($data->actual_payment));
        if($os_payment > 0){
            $status = 0;
        }else{
            $status = 1;
            PaymentModels::where('id', $id_payment)->update(['status' => 1]);
            OrderModels::where('no_order', $no_order)->update(['status' => 3]);
        }
        
        try {
            $order_save                 = new PaymentActualModels();
            $order_save->id_payment     = $id_payment;
            $order_save->actual_payment = $actual_payment_input;

            $order_save->save();
            
            $msg = 'Data berhasil di simpan';
            return response()->json(['success' => true, 'message' => $msg]);
        } catch (Exception $e) {
            // report($e);
            $msg = $e;
            return response()->json(['success' => false, 'message' => $msg]);
        }
        
    }
}