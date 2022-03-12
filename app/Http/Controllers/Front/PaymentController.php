<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModels;
use App\Helpers\Helper;
use DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $session_user = Session()->get('sess_nama');
        // dd($session_user);
        $data = DB::table('ttrx_chart')
                ->join('tmst_product', 'tmst_product.id', '=', 'ttrx_chart.id_product')
                ->leftJoin('ttrx_order', 'ttrx_order.id_chart', '=', 'ttrx_chart.id')
                ->select('ttrx_chart.*', 'tmst_product.nama', 'tmst_product.harga', 'tmst_product.file_name', 'ttrx_order.no_order')
                ->wherenull('ttrx_order.no_order')
                ->where('ttrx_chart.user_at',$session_user)
                ->get();
        return view('front.payment',compact('data'));
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
            }
            $order_save                  = new OrderModels();
            $order_save->no_order        = $no_order;
            $order_save->tgl_order       = Date('Y-m-d');
            $order_save->id_user         = $session_id;
            $order_save->id_product      = $id_product;
            $order_save->id_chart        = $value;
            $order_save->status          = 1;
            $order_save->user_at         = $session_user;

            $order_save->save();
        }
        $msg = 'Data berhasil di simpan';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function list_produk(Request $request)
    {
        $session_user = Session()->get('sess_nama');
        foreach ($request->check_id as $value) {
            $data = DB::table('ttrx_chart')
                    ->join('tmst_product', 'tmst_product.id', '=', 'ttrx_chart.id_product')
                    ->leftJoin('ttrx_order', 'ttrx_order.id_chart', '=', 'ttrx_chart.id')
                    ->select('ttrx_chart.*', 'tmst_product.nama', 'tmst_product.harga', 'tmst_product.file_name', 'ttrx_order.no_order')
                    ->where('ttrx_chart.id',$value)
                    ->first();
            // if($data){
            //     $nestedData['id']
            //     $data[] = $nestedData;
            // }
        }
        
        // dd($session_user);
        
    }
}
