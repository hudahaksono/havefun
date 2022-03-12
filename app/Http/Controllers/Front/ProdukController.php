<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Session;
use App\Models\ChartModels;
use Redirect, Response, DB;
use Illuminate\Support\Facades\Session;

class ProdukController extends Controller
{
    public function index()
    {
        $kategori = DB::table('tmst_kategori')->where('status_hapus',0)->get();
        $kategori_first = DB::table('tmst_kategori')->where('status_hapus',0)->first();
        $id_kategori_first = $kategori_first->id;
        return view('front.product', compact('kategori','id_kategori_first'));
    } 

    public function list_produk(Request $request)
    {
        $id_kategori = $request->id_kategori;
        $data = DB::table('qview_mst_barang')
            ->where('id_kategori',$id_kategori)
            ->get();
        return response()->json($data);
    }

    public function detail_produk(Request $request)
    {
        $id = $request->id;
        $data = DB::table('qview_mst_barang')
            ->where('id',$id)
            ->first();
        return response()->json($data);
    }

    public function store_chart(Request $request)
    {
        // DB::beginTransaction();
        // $session_user = Session('sess_nama');
        // dd($session_user);
        $data_cek = DB::table('ttrx_chart')
                    ->where([['user_at',$request->session_nama],['id_product',$request->id]])
                    ->count();
        if($data_cek>0){
            $msg = 'Produk sudah ada di chart !';
            return response()->json(['success' => false, 'message' => $msg]);
        }else{
            try {
                $data_hdr['id_product']     = $request->id;
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
