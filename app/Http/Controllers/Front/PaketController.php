<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChartModels;
use Redirect, Response, DB;
use Illuminate\Support\Facades\Session;

class PaketController extends Controller
{
    public function index()
    {
        $kategori = DB::table('tmst_kategori')->where('status_hapus',0)->get();
        $kategori_first = DB::table('tmst_kategori')->where('status_hapus',0)->first();
        $id_kategori_first = $kategori_first->id;
        return view('front.paket', compact('kategori','id_kategori_first'));
    }

    public function list_produk(Request $request)
    {
        $id_kategori = $request->id_kategori;
        $data = DB::table('tmst_paket')
            ->where([['id_kategori','=',$id_kategori],['status_hapus','=',0]])
            ->get();
        return response()->json($data);
    }

    public function detail_produk(Request $request)
    {
        $id = $request->id;
        $data = DB::table('tmst_paket')
            ->where([['id','=',$id],['status_hapus','=',0]])
            ->first();
        return response()->json($data);
    }

    public function detail_produk_paket(Request $request)
    {
        $id_hdr = $request->id_hdr;
        $data = DB::table('tmst_paket_product')
            ->join('tmst_product', 'tmst_product.id', '=', 'tmst_paket_product.id_product')
            ->select('tmst_paket_product.id_hdr', 'tmst_product.nama', 'tmst_product.nama_singkat', 'tmst_product.file_name', 'tmst_product.keterangan', 'tmst_product.harga')
            ->where([['tmst_paket_product.id_hdr','=',$id_hdr],['tmst_product.status_hapus','=',0]])
            ->get();
        return response()->json($data);
    }

    public function store_chart(Request $request)
    {
        // DB::beginTransaction();
        // $session_user = Session('sess_nama');
        // dd($session_user);
        $data_cek = DB::table('ttrx_chart')
                    ->where([['user_at',$request->session_nama],['id_paket',$request->id]])
                    ->count();
        if($data_cek>0){
            $msg = 'Produk sudah ada di chart !';
            return response()->json(['success' => false, 'message' => $msg]);
        }else{
            try {
                $data_hdr['id_paket']       = $request->id;
                $data_hdr['qty']            = $request->qty;
                $data_hdr['user_at']        = $request->session_nama;

                $data_save_hdr = ChartModels::create($data_hdr);

                $msg = 'Data berhasil di simpan';
                return response()->json(['success' => true, 'message' => $msg]);
                // Db::commit();
            } catch (\Exception $e) {
                // Db::rollback();
                return response()->json(['success' => false,'message'=>$e->getMessage()]);
            }
        }
    }
}
