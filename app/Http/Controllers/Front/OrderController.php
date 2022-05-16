<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Redirect, Response, DB;

class OrderController extends Controller
{
    public function index()
    {
        $session_user = Session()->get('sess_nama');
        $data_paket = DB::table('qview_order_dtl_paket')
                        ->where('user_at', '=', $session_user);
        $data = DB::table('qview_order_dtl')
            ->where('user_at', '=', $session_user)
            ->union($data_paket)
            ->get();
            // dd($data);

        $total_chart = DB::table('ttrx_chart')
                    ->leftjoin('ttrx_order', 'ttrx_order.id_chart', '=', 'ttrx_chart.id')
                    ->wherenull('ttrx_order.status')
                    ->where([['ttrx_chart.user_at',Session('sess_nama')]])
                    ->count();
        return view('front.myorder', compact('data','total_chart'));
    } 
}
