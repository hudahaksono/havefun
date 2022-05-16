<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModels;
use App\Helpers\Helper;
use App\Models\PaymentModels;
use DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $no_order = $request->no_order;
        $session_user = Session()->get('sess_nama');
        $data_paket = DB::table('ttrx_order')
                ->Join('tmst_paket', 'tmst_paket.id', '=', 'ttrx_order.id_paket')
                ->select('ttrx_order.*', 'tmst_paket.nama', 'tmst_paket.harga', 'tmst_paket.file_name')
                ->where('ttrx_order.no_order',$no_order);
        $data = DB::table('ttrx_order')
                ->Join('tmst_product', 'tmst_product.id', '=', 'ttrx_order.id_product')
                ->select('ttrx_order.*', 'tmst_product.nama', 'tmst_product.harga', 'tmst_product.file_name')
                ->where('ttrx_order.no_order',$no_order)
                ->union($data_paket)
                ->get();
                // dd($data);

        $total_chart = DB::table('ttrx_chart')
                    ->leftjoin('ttrx_order', 'ttrx_order.id_chart', '=', 'ttrx_chart.id')
                    ->wherenull('ttrx_order.status')
                    ->where([['ttrx_chart.user_at',Session('sess_nama')]])
                    ->count();
                    
        return view('front.payment',compact('data','no_order','total_chart'));
    }

    public function store_payment(Request $request)
    {
        $no_order = $request->no_order;
        $year = date('Y');
        $month = date('m');
        $last_doc_no = Helper::create_doc_no('PAYMENT', $month, $year);
        $no_payment = 'INV-'.Helper::right($year, 2) . $month . "-" .Helper::right("0000" . $last_doc_no, 4);
        $data = [
                'status'  => 3
            ];
        OrderModels::where('no_order', $request->no_order)->update($data);

        $data_paket = DB::table('qview_order_dtl_paket')
                    ->select('harga')
                    ->where('no_order', $request->no_order);
        $data_order = DB::table('qview_order_dtl')
                    ->select('harga')
                    ->where('no_order', $request->no_order)
                    ->union($data_paket)
                    ->get();
        
        $harga = 0;
        $total = 0;
        foreach ($data_order as $value) {
            $harga = $value->harga;
            $total = floatval($total) + floatval($harga);
        }

        $payment                    = new PaymentModels();
        $payment->no_payment        = $no_payment;
        $payment->tgl_payment       = date('Y-m-d');
        $payment->total_payment     = $total;
        $payment->id_user           = $request->sess_id;
        // $payment->id_order          = $id_order;
        $payment->no_order          = $request->no_order;
        $payment->tgl_acara         = Date('Y-m-d', strtotime($request->tgl_acara));
        $payment->alamat_acara      = $request->alamat_acara;
        $payment->status            = 0;
        $payment->user_at           = $request->sess_nama;

        $payment->save();

        $msg = 'Pembayaran berhasil ! ! !';
        return response()->json(['success' => true, 'message' => $msg, 'no_order' => $no_order]);
    }

    public function store_order(Request $request)
    {
        $year = date('Y');
        $month = date('m');
        $last_doc_no = Helper::create_doc_no('ORDER', $month, $year);
        $no_order = 'NP-'.Helper::right($year, 2) . $month . "-" .Helper::right("0000" . $last_doc_no, 4);
        // $id_user = Session()->get('sess_id');
        $session_user = $request->detail_sess_nama;
        $session_id = $request->detail_sess_id;

        foreach ($request->check_id as $value) {
            $data_chart = DB::table('ttrx_chart')->where('id',$value)->first();
            if($data_chart){
                $id_product = $data_chart->id_product;
                $id_paket = $data_chart->id_paket;
                $qty = $data_chart->qty;
            }
            $order_save                  = new OrderModels();
            $order_save->no_order        = $no_order;
            $order_save->tgl_order       = Date('Y-m-d');
            $order_save->id_user         = $session_id;
            if($id_product!=0){
                $order_save->id_product  = $id_product;
            }else{
                $order_save->id_paket    = $id_paket;
            }
            
            $order_save->id_chart        = $value;
            $order_save->qty             = $qty;
            $order_save->status          = 1;
            $order_save->user_at         = $session_user;

            $order_save->save();
        }
        $msg = 'Data berhasil di simpan';
        return response()->json(['success' => true, 'message' => $msg, 'no_order' => $no_order]);
    }

    public function list_produk(Request $request)
    {
        $no_order = $request->no_order;
        $data = DB::table('ttrx_order')
                ->leftJoin('tmst_product', 'tmst_product.id', '=', 'ttrx_order.id_product')
                ->select('ttrx_order.*', 'tmst_product.nama', 'tmst_product.harga', 'tmst_product.file_name')
                ->where('ttrx_order.no_order',$no_order)
                ->get();
        return $data;
    }
}
