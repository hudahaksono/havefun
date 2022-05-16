<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\MessageModels;
use Redirect, Response, DB;
use Illuminate\Support\Carbon;

class FrontController extends Controller
{
    public function index()
    {
        $top_product = DB::table('qview_dashboard_top_product')
                        ->join('tmst_product', 'qview_dashboard_top_product.id_product', '=', 'tmst_product.id')
                        ->get();
        $banner = DB::table('tmst_banner')->get();
        $total_chart = DB::table('ttrx_chart')
                    ->leftjoin('ttrx_order', 'ttrx_order.id_chart', '=', 'ttrx_chart.id')
                    ->wherenull('ttrx_order.status')
                    ->where([['ttrx_chart.user_at',Session('sess_nama')]])
                    ->count();

        return view('front.index', compact('banner','total_chart','top_product'));
    }

    public function index_about()
    {
        $total_chart = DB::table('ttrx_chart')
                    ->leftjoin('ttrx_order', 'ttrx_order.id_chart', '=', 'ttrx_chart.id')
                    ->wherenull('ttrx_order.status')
                    ->where([['ttrx_chart.user_at',Session('sess_nama')]])
                    ->count();
                    
        return view('front.about', compact('total_chart'));
    }

    public function index_profil()
    {
        $total_chart = DB::table('ttrx_chart')
                    ->leftjoin('ttrx_order', 'ttrx_order.id_chart', '=', 'ttrx_chart.id')
                    ->wherenull('ttrx_order.status')
                    ->where([['ttrx_chart.user_at',Session('sess_nama')]])
                    ->count();
                    
        return view('front.profile', compact('total_chart'));
    }

    public function store(Request $request)
    {
        $data =  new MessageModels();
        $data->nama = $request->nama;
        $data->email = $request->email;

        // Ubah Format Tanggal
        $data_tanggal = $request->tanggal;
        $tanggal = Carbon::createFromFormat('d/m/Y', $data_tanggal)->format('Y-m-d');

        $data->tanggal = $tanggal;
        $data->no_tlp = $request->no_tlp;
        $data->pesan = $request->pesan;
        $data->save();

        $msg = 'Data berhasil Disimpan';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function store2(Request $request)
    {
        $data =  new MessageModels();
        $data->nama = $request->nama2;
        $data->email = $request->email2;

        // Ubah Format Tanggal
        $data_tanggal = $request->tanggal2;
        $tanggal = Carbon::createFromFormat('d/m/Y', $data_tanggal)->format('Y-m-d');

        $data->tanggal = $tanggal;
        $data->no_tlp = $request->no_tlp2;
        $data->pesan = $request->pesan2;
        $data->save();

        $msg = 'Data berhasil Disimpan';
        return response()->json(['success' => true, 'message' => $msg]);
    }
}
