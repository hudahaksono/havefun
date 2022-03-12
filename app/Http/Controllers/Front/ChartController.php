<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class ChartController extends Controller
{
    public function index()
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
        // dd($data);
        return view('front.cart',compact('data'));
    }

    // public function list_produk(Request $request)
    // {

    // }
}
