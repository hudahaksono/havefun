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
            ->select(DB::raw('no_order,timediff("' . $date_now . '",created_at) as selisih '))
            ->where('status', 1)
            ->where('created_at', '>=', $date)
            ->get();
        $pembayaran = DB::table('ttrx_payment')
            ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
            ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.total_payment', 'ttrx_actual_payment.flag_dp', DB::raw('timediff("' . $date_now . '",ttrx_actual_payment.created_at) as selisih'))
            ->where('ttrx_actual_payment.created_at', '>=', $date)
            ->get();
        $user_baru = DB::table('mst_users')
            ->select(DB::raw('nama,timediff("' . $date_now . '",created_at) as selisih '))
            ->where('created_at', '>=', $date)
            ->get();

        return view('office.dashboard', compact('order_baru', 'pembayaran', 'user_baru'));
    }

    public function list_data(Request $request)
    {
        $user = DB::table('mst_users')
            ->count();

        $customer = DB::table('qview_dashboard_user_customer')
            ->count();

        $jumlah_outstanding = DB::table('ttrx_payment')
            ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
            ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
            ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'), 'ttrx_payment.total_diskon')
            ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', 'ttrx_payment.total_diskon')
            ->havingraw('ttrx_payment.total_payment - SUM(ttrx_actual_payment.actual_payment) > 0')
            ->count();

        $jumlah_lunas = DB::table('ttrx_payment')
            ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
            ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
            ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'), 'ttrx_payment.total_diskon')
            ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', 'ttrx_payment.total_diskon')
            ->havingraw('ttrx_payment.total_payment - SUM(ttrx_actual_payment.actual_payment) > 0')
            ->count();

        $outstanding = DB::table('ttrx_payment')
            ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
            ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
            ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'), 'ttrx_payment.total_diskon')
            ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', 'ttrx_payment.total_diskon')
            ->havingraw('ttrx_payment.total_payment - SUM(ttrx_actual_payment.actual_payment) > 0')
            ->get();

        $lunas = DB::table('ttrx_payment')
            ->join('mst_users', 'ttrx_payment.id_user', '=', 'mst_users.id')
            ->leftJoin('ttrx_actual_payment', 'ttrx_payment.id', '=', 'ttrx_actual_payment.id_payment')
            ->select('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', DB::raw('SUM(ttrx_actual_payment.actual_payment) as actual_payment'), 'ttrx_payment.total_diskon')
            ->groupBy('ttrx_payment.id', 'ttrx_payment.no_payment', 'ttrx_payment.tgl_payment', 'ttrx_payment.no_order', 'mst_users.nama', 'ttrx_payment.total_payment', 'ttrx_payment.total_diskon')
            ->havingraw('ttrx_payment.total_payment - SUM(ttrx_actual_payment.actual_payment) > 0')
            ->get();

        $top_product = DB::table('qview_dashboard_top_product')
            ->get();

        $top_paket = DB::table('qview_dashboard_top_paket')
            ->get();

        $jumlah_pembelian = DB::table('qview_dashboard_penjualan_bulanan')
            ->get();



        return response()
            ->json([
                'user' => $user,
                'customer' => $customer,
                'outstanding' => $outstanding,
                'lunas' => $lunas,
                'jumlah_outstanding' => $jumlah_outstanding,
                'jumlah_lunas' => $jumlah_lunas,
                'top_product' => $top_product,
                'top_paket' => $top_paket,
                'jumlah_pembelian' => $jumlah_pembelian
            ]);
    }
}
