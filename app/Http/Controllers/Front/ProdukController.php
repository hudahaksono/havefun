<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModels;
use App\Models\ChartModels;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Session;
use Redirect, Response, DB;

class ProdukController extends Controller
{
    public function index()
    {
        $kategori = DB::table('tmst_kategori')->where('status_hapus',0)->get();
        $kategori_first = DB::table('tmst_kategori')->where('status_hapus',0)->first();
        $id_kategori_first = $kategori_first->id;

        //total chart
        $total_chart = DB::table('ttrx_chart')
                    ->leftjoin('ttrx_order', 'ttrx_order.id_chart', '=', 'ttrx_chart.id')
                    ->wherenull('ttrx_order.status')
                    ->where([['ttrx_chart.user_at',Session('sess_nama')]])
                    ->count();
        
        return view('front.product', compact('kategori','id_kategori_first','total_chart'));
    } 

    public function list_produk(Request $request)
    {
        $id_kategori = $request->id_kategori;
        $data = DB::table('qview_mst_barang')
            ->where([['id_kategori','=',$id_kategori],['status_hapus','=',0]])
            ->get();
        return response()->json($data);
    }

    public function detail_produk(Request $request)
    {
        $id = $request->id;
        $data = DB::table('qview_mst_barang')
            ->where([['id','=',$id],['status_hapus','=',0]])
            ->first();
        return response()->json($data);
    }

    public function store_chart(Request $request)
    {
        // DB::beginTransaction();
        // $session_user = Session('sess_nama');
        // dd($session_user);
        $data_cek = DB::table('ttrx_chart')
                    ->leftjoin('ttrx_order', 'ttrx_chart.id', '=', 'ttrx_order.id_chart')
                    // ->wherenull('ttrx_order.no_order')
                    ->select('ttrx_chart.id','ttrx_order.no_order')
                    ->where([['ttrx_chart.user_at',$request->session_nama],['ttrx_chart.id_product',$request->id],['ttrx_order.no_order',null]])
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

    public function store_barang(Request $request)
    {
        try {
            $year = date('Y');
            $month = date('m');
            $last_doc_no = Helper::create_doc_no('ORDER', $month, $year);
            $no_order = 'NP-'.Helper::right($year, 2) . $month . "-" .Helper::right("0000" . $last_doc_no, 4);
            $session_user = $request->session_nama;
            $session_id   = $request->session_id;
            $id_product   = $request->id_product;
            $qty_product  = $request->qty_product;

            $order_save                  = new OrderModels();
            $order_save->no_order        = $no_order;
            $order_save->tgl_order       = Date('Y-m-d');
            $order_save->id_user         = $session_id;
            $order_save->id_product      = $id_product;
            
            // $order_save->id_chart        = $value;
            $order_save->qty             = $qty_product;
            $order_save->status          = 1;
            $order_save->user_at         = $session_user;

            $order_save->save();

            $msg = 'Data berhasil di simpan';
            return response()->json(['success' => true, 'message' => $msg, 'no_order' => $no_order]);
        } catch (\Exception $e) {
            return response()->json(['success' => false,'message'=>$e->getMessage()]);
        }
        
    }
}
