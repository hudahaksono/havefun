<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Auth\UserModels;
use DateTime;
use DB;

class MenuController extends Controller
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

        return view('office.dashboard', compact('order_baru','pembayaran','user_baru'));
    }
}
