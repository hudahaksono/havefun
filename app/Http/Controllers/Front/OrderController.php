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
        return view('front.myorder', compact('data'));
    } 
}
