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
        $banner = DB::table('tmst_banner')->get();
        return view('front.index', compact('banner'));
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
