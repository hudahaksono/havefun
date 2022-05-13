<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use PDF;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\OrderModels;
use App\Models\PaymentModels;
use App\Helpers\Helper;

use Datatables;
use Redirect, Response;
use DateTime;
use DB;

class InvoiceController extends Controller
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
        return view('office.report.rpt-invoice-lunas', compact('order_baru','pembayaran','user_baru'));
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
                        ->where('status', '=', 1)
                        ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = DB::table('ttrx_payment')
                        ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
                        ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
                        ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'), 'ttrx_payment.total_diskon')
                        ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', 'ttrx_payment.total_diskon')
                        ->offset($start)
                        ->limit($limit)
                        ->where('status', '=', 1)
                        ->get();
        } else {
            $search = $request->input('search.value');

            $posts =  DB::table('ttrx_payment')
                        ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
                        ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
                        ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'), 'ttrx_payment.total_diskon')
                        ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', 'ttrx_payment.total_diskon')
                        ->offset($start)
                        ->limit($limit)
                        ->where([['status', '=', 1],['ttrx_payment.no_payment', 'LIKE', "%{$search}%"]])
                        ->Where([['status', '=', 1],['ttrx_payment.no_order', 'LIKE', "%{$search}%"]])
                        ->Where([['status', '=', 1],['mst_users.nama', 'LIKE', "%{$search}%"]])
                        ->orderBy('ttrx_payment.tgl_payment')
                        ->get();

            $totalFiltered = DB::table('ttrx_payment')
                        ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
                        ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
                        ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'), 'ttrx_payment.total_diskon')
                        ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', 'ttrx_payment.total_diskon')
                        ->where([['status', '=', 1],['ttrx_payment.no_payment', 'LIKE', "%{$search}%"]])
                        ->Where([['status', '=', 1],['ttrx_payment.no_order', 'LIKE', "%{$search}%"]])
                        ->Where([['status', '=', 1],['mst_users.nama', 'LIKE', "%{$search}%"]])
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
                $nestedData['total_payment'] = $post->total_payment - $post->total_diskon;
                $nestedData['actual_payment'] = $post->actual_payment;
                $nestedData['os_payment'] = floatval($post->total_payment) - ($post->actual_payment);
                $nestedData['nama'] = $post->nama;
                
                $nestedData['action'] = "&emsp;<a href='javascript:void(0)' id='cetak' data-toggle='tooltip' title='Tindak Lanjut' data-id='$post->id' data-original-title='' class='Edit btn btn-primary btn-sm'><i class='fa fa-location-arrow'></i> &nbsp; Cetak Invoice </a>";
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

    public function generatelunas(Request $request)
    {
            $id = $request->id;
            $data_hdr = DB::table('ttrx_payment')
                            ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
                            ->where('ttrx_payment.id',$id)
                            ->first();
            $data_dtl = DB::table('ttrx_payment')
                            ->join('ttrx_order', 'ttrx_payment.no_order', '=', 'ttrx_order.no_order')
                            ->join('tmst_product', 'ttrx_order.id_product', '=', 'tmst_product.id')
                            ->select(DB::raw('tmst_product.nama AS product_name, ttrx_order.qty, tmst_product.harga, ttrx_order.qty*tmst_product.harga as total, ttrx_payment.total_diskon'))
                            ->where('ttrx_payment.id',$id)
                            ->get();
                            // dd(public_path('images/savana/logo.png'));
            $data = ['title' => 'Invoice No : '.$data_hdr->no_payment, 'data_hdr' => $data_hdr, 'data_dtl' => $data_dtl];
        // $title = 'Invoice No : '.$data_hdr->no_payment;
        // return view('office.invoice.invoice-lunas', compact('data_hdr','data_dtl','title'));
        $pdf = PDF::loadView('office.invoice.invoice-lunas', $data);
        return $pdf->stream();
    }

    public function index_os()
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
        return view('office.report.rpt-invoice', compact('order_baru','pembayaran','user_baru'));
    }

    public function list_data_hdr_os(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'no_order',
            3 => 'tgl_order',
            4 => 'action'
        );

        $tData = DB::table('ttrx_payment')
                        ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
                        ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
                        ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'), 'ttrx_payment.total_diskon')
                        ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', 'ttrx_payment.total_diskon')
                        ->havingraw('ttrx_payment.total_payment - SUM(ttrx_actual_payment.actual_payment) > 0')
                        ->get();
        $totalData = count($tData);
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = DB::table('ttrx_payment')
                        ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
                        ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
                        ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'), 'ttrx_payment.total_diskon')
                        ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', 'ttrx_payment.total_diskon')
                        ->offset($start)
                        ->limit($limit)
                        // ->where('status', '=', 0)
                        ->havingraw('ttrx_payment.total_payment - SUM(ttrx_actual_payment.actual_payment) > 0')
                        ->get();
            // $totalData = count($posts);
            // $totalFiltered = $totalData;
        } else {
            $search = $request->input('search.value');

            $posts =  DB::table('ttrx_payment')
                        ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
                        ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
                        ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'), 'ttrx_payment.total_diskon')
                        ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', 'ttrx_payment.total_diskon')
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
                        ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'), 'ttrx_payment.total_diskon')
                        ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', 'ttrx_payment.total_diskon')
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
                $nestedData['total_payment'] = $post->total_payment - $post->total_diskon;
                $nestedData['actual_payment'] = $post->actual_payment;
                $nestedData['os_payment'] = floatval($post->total_payment) - ($post->actual_payment);
                $nestedData['nama'] = $post->nama;
                
                $nestedData['action'] = "&emsp;<a href='javascript:void(0)' id='cetak' data-toggle='tooltip' title='Tindak Lanjut' data-id='$post->id' data-original-title='' class='Edit btn btn-primary btn-sm'><i class='fa fa-location-arrow'></i> &nbsp; Cetak Invoice </a>";
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

    public function generateoutstanding(Request $request)
    {
        $id = $request->id;
        $data_hdr = DB::table('ttrx_payment')
                        ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
                        ->where('ttrx_payment.id',$id)
                        ->first();
        $data_dtl = DB::table('ttrx_payment')
                        ->join('ttrx_order', 'ttrx_payment.no_order', '=', 'ttrx_order.no_order')
                        ->join('tmst_product', 'ttrx_order.id_product', '=', 'tmst_product.id')
                        ->select(DB::raw('tmst_product.nama AS product_name, ttrx_order.qty, tmst_product.harga, ttrx_order.qty*tmst_product.harga as total, ttrx_payment.total_diskon'))
                        ->where('ttrx_payment.id',$id)
                        ->get();
                        
        $data = ['title' => 'Invoice No : '.$data_hdr->no_payment, 'data_hdr' => $data_hdr, 'data_dtl' => $data_dtl];
        $pdf = PDF::loadView('office.invoice.invoice-outstanding', $data);
        return $pdf->stream();
    }
}
