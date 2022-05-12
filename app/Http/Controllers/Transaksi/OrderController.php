<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\OrderModels;
use App\Models\PaymentModels;
use App\Helpers\Helper;

use Datatables;
use Redirect, Response;
use DateTime;
use DB;

class OrderController extends Controller
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
        return view('office.transaksi.tr-order', compact('order_baru','pembayaran','user_baru'));
    }

    public function list_data_hdr(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'no_order',
            3 => 'tgl_order',
            4 => 'action'
        );

        $totalData = DB::table('qview_order_hdr')
            // ->where('status_hapus', '=', 0)
            ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        // $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = DB::table('qview_order_hdr')
                ->offset($start)
                ->limit($limit)
                // ->where('status_hapus', '=', 0)
                ->orderBy('status')
                ->get();
        } else {
            $search = $request->input('search.value');

            $posts =  DB::table('qview_order_hdr')
                ->offset($start)
                ->limit($limit)
                ->where([['no_order', 'LIKE', "%{$search}%"]])
                ->Where([['nama', 'LIKE', "%{$search}%"]])
                ->orderBy('status')
                ->get();

            $totalFiltered = DB::table('qview_order_hdr')
                ->where([['no_order', 'LIKE', "%{$search}%"]])
                ->Where([['nama', 'LIKE', "%{$search}%"]])
                ->count();
        }

        $data = array();
        $i = $start + 1;
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['id'] = $post->no_order;
                $nestedData['DT_RowIndex'] = $i;
                $nestedData['no_order'] = $post->no_order;
                $nestedData['tgl_order'] = $post->tgl_order;
                $nestedData['id_user'] = $post->id_user;
                $nestedData['id_product'] = $post->id_product;
                $nestedData['nama'] = $post->nama;
                $nestedData['email'] = $post->email;
                $nestedData['no_tlp'] = $post->no_tlp;
                $nestedData['f_status'] = $post->status;
                if($post->status==1){
                    $nestedData['status_order'] = '<span class="badge badge-success">New Order</span>';
                    $nestedData['action'] = "<a href='javascript:void(0)' id='tindak_lanjut' data-toggle='tooltip' title='Proses' data-id='$post->no_order' data-original-title='' class='Edit btn btn-primary btn-sm'><i class='fa fa-location-arrow'></i></a>
                                        <a href='javascript:void(0)' id='delete_data_hdr' data-toggle='tooltip' title='Delete' data-id='$post->no_order' data-original-title='' class='Delete btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></a>";
                }else if($post->status==2){
                    $nestedData['status_order'] = '<span class="badge badge-warning">Menunggu Pembayaran</span>';
                    $nestedData['action'] = "&emsp;<a href='javascript:void(0)' id='delete_data_hdr' data-toggle='tooltip' title='Delete' data-id='$post->no_order' data-original-title='' class='Delete btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i> &nbsp; Hapus </a>";
                }else if($post->status==3){
                    $nestedData['status_order'] = '<span class="badge badge-primary">Pembayaran Berhasil</span>';
                    $nestedData['action'] = "&emsp;<a href='javascript:void(0)' id='sudah_tindak_lanjut' data-toggle='tooltip' title='Detail' data-id='$post->no_order' data-original-title='' class='Edit btn btn-primary btn-sm'><i class='fa fa-info'></i> &nbsp;Detail </a>";
                }else{
                    $nestedData['status_order'] = '-';
                }
                
                $data[] = $nestedData;
                $i++;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function list_data_dtl(Request $request)
    {
        $no_order = $request->no_order;
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'no_order',
            3 => 'tgl_order',
            4 => 'action'
        );

        $data_paket = DB::table('qview_order_dtl_paket')
                        ->where('no_order', '=', $no_order);
        $totalData = DB::table('qview_order_dtl')
            ->where('no_order', '=', $no_order)
            ->union($data_paket)
            ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        // $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $data_paket = DB::table('qview_order_dtl_paket')
                        ->offset($start)
                        ->limit($limit)
                        ->where('no_order', '=', $no_order);
            $posts = DB::table('qview_order_dtl')
                ->offset($start)
                ->limit($limit)
                ->where('no_order', '=', $no_order)
                ->orderBy('status')
                ->union($data_paket)
                ->get();
        } else {
            $search = $request->input('search.value');

            $data_paket = DB::table('qview_order_dtl_paket')
                        ->offset($start)
                        ->limit($limit)
                        ->Where([['no_order', '=', $no_order],['product_name', 'LIKE', "%{$search}%"]]);
            $posts =  DB::table('qview_order_dtl')
                ->offset($start)
                ->limit($limit)
                // ->where([['no_order', 'LIKE', "%{$search}%"]])
                ->Where([['no_order', '=', $no_order],['product_name', 'LIKE', "%{$search}%"]])
                ->orderBy('status')
                ->union($data_paket)
                ->get();

            $totalFiltered = DB::table('qview_order_dtl')
                // ->where([['no_order', 'LIKE', "%{$search}%"]])
                ->Where([['no_order', '=', $no_order],['product_name', 'LIKE', "%{$search}%"]])
                ->union($data_paket)
                ->count();
        }

        $data = array();
        $i = $start + 1;
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['id'] = $post->id;
                $nestedData['DT_RowIndex'] = $i;
                $nestedData['no_order'] = $post->no_order;
                $nestedData['tgl_order'] = $post->tgl_order;
                $nestedData['id_user'] = $post->id_user;
                $nestedData['id_product'] = $post->id_product;
                $nestedData['product_name'] = $post->product_name;
                $nestedData['nama'] = $post->nama;
                $nestedData['email'] = $post->email;
                $nestedData['no_tlp'] = $post->no_tlp;
                $nestedData['harga'] = $post->harga;
                $nestedData['kategori'] = $post->kategori;
                if($post->status==1){
                    $nestedData['status_order'] = '<span class="badge badge-success">New Order</span>';
                    $nestedData['action'] = "&emsp;<a href='javascript:void(0)' id='delete_data_dtl' data-toggle='tooltip' title='Delete' data-id='$post->no_order' data-original-title='' class='Delete btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i> &nbsp; Hapus </a>";
                }else if($post->status==2){
                    $nestedData['status_order'] = '<span class="badge badge-warning">Menunggu Pembayaran</span>';
                    $nestedData['action'] = '-';
                }else if($post->status==3){
                    $nestedData['status_order'] = '<span class="badge badge-primary">Tindak Lanjut</span>';
                    $nestedData['action'] = '-';
                }else{
                    $nestedData['status_order'] = '-';
                    $nestedData['action'] = '-';
                }
                
                $data[] = $nestedData;
                $i++;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function list_data_barang(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'nama',
            3 => 'keterangan',
            4 => 'action'
        );

        $totalData = DB::table('tmst_product')
            ->where('status_hapus', '=', 0)
            ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = DB::table('tmst_product')
                ->select(DB::raw('tmst_product.*,tmst_kategori.nama as nama_kategori'))
                ->join('tmst_kategori','tmst_product.id_kategori','=','tmst_kategori.id')
                ->offset($start)
                ->limit($limit)
                ->where('tmst_product.status_hapus', '=', 0)
                ->orderBy('tmst_product.nama')
                ->get();
        } else {
            $search = $request->input('search.value');

            $posts =  DB::table('tmst_product')
                ->select(DB::raw('tmst_product.*,tmst_kategori.nama as nama_kategori'))
                ->join('tmst_kategori','tmst_product.id_kategori','=','tmst_kategori.id')
                ->offset($start)
                ->limit($limit)
                // ->where([['status_hapus', '=', 0], ['kode', 'LIKE', "%{$search}%"]])
                ->Where([['tmst_product.status_hapus', '=', 0], ['tmst_product.nama', 'LIKE', "%{$search}%"]])
                ->orderBy('tmst_product.nama')
                ->get();

            $totalFiltered = DB::table('tmst_product')
                // ->where([['status_hapus', '=', 0], ['kode', 'LIKE', "%{$search}%"]])
                ->Where([['status_hapus', '=', 0], ['nama', 'LIKE', "%{$search}%"]])
                ->count();
        }

        $data = array();
        $i = $start + 1;
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['id'] = $post->id;
                $nestedData['DT_RowIndex'] = $i;
                // $nestedData['kode'] = $post->kode;
                $nestedData['nama'] = $post->nama;
                $nestedData['keterangan'] = $post->keterangan;
                $nestedData['harga'] = $post->harga;
                $nestedData['kategori'] = $post->nama_kategori;
                
                $data[] = $nestedData;
                $i++;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function list_data_paket(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'nama',
            3 => 'keterangan',
            4 => 'action'
        );

        $totalData = DB::table('tmst_paket')
            ->where('status_hapus', '=', 0)
            ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = DB::table('tmst_paket')
                ->select(DB::raw('tmst_paket.*,tmst_kategori_paket.nama as nama_kategori'))
                ->join('tmst_kategori_paket','tmst_paket.id_kategori','=','tmst_kategori_paket.id')
                ->offset($start)
                ->limit($limit)
                ->where('tmst_paket.status_hapus', '=', 0)
                ->orderBy('tmst_paket.nama')
                ->get();
        } else {
            $search = $request->input('search.value');

            $posts =  DB::table('tmst_paket')
                ->select(DB::raw('tmst_paket.*,tmst_kategori_paket.nama as nama_kategori'))
                ->join('tmst_kategori_paket','tmst_paket.id_kategori','=','tmst_kategori_paket.id')
                ->offset($start)
                ->limit($limit)
                // ->where([['status_hapus', '=', 0], ['kode', 'LIKE', "%{$search}%"]])
                ->Where([['tmst_paket.status_hapus', '=', 0], ['tmst_paket.nama', 'LIKE', "%{$search}%"]])
                ->orderBy('tmst_paket.nama')
                ->get();

            $totalFiltered = DB::table('tmst_paket')
                // ->where([['status_hapus', '=', 0], ['kode', 'LIKE', "%{$search}%"]])
                ->Where([['status_hapus', '=', 0], ['nama', 'LIKE', "%{$search}%"]])
                ->count();
        }

        $data = array();
        $i = $start + 1;
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['id'] = $post->id;
                $nestedData['DT_RowIndex'] = $i;
                // $nestedData['kode'] = $post->kode;
                $nestedData['nama'] = $post->nama;
                $nestedData['keterangan'] = $post->keterangan;
                $nestedData['harga'] = $post->harga;
                $nestedData['kategori'] = $post->nama_kategori;
                
                $data[] = $nestedData;
                $i++;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function store(Request $request)
    {
        $no_order       = $request->no_order_input;
        $tgl_order      = $request->tgl_order_input;
        $session_user   = $request->detail_sess_nama;
        $session_id     = $request->detail_sess_id;
        $id_product     = $request->barang_id;
        $qty            = $request->qty;
        // session::put('sess_nama', 'test message 1');
        // dd(Session::get('sess_nama'));
        $data_cek = OrderModels::where([['no_order','=',$no_order],['id_product','=',$id_product]])->count();
        if ($data_cek>0) {
            $msg = 'Tidak bisa input produk yang sama';
            return response()->json(['success' => false, 'message' => $msg]);
        }else{
            $order_save                  = new OrderModels();
            $order_save->no_order        = $no_order;
            $order_save->tgl_order       = Date('Y-m-d', strtotime($tgl_order));
            $order_save->id_user         = $session_id;
            $order_save->id_product      = $id_product;
            $order_save->qty             = $qty;
            $order_save->status          = 1;
            $order_save->status_product  = 1;
            $order_save->user_at         = $session_user;

            $order_save->save();
            
            $msg = 'Data berhasil di simpan';
            return response()->json(['success' => true, 'message' => $msg]);
        }
    }

    public function store_paket(Request $request)
    {
        $no_order       = $request->no_order_input;
        $tgl_order      = $request->tgl_order_input;
        $session_user   = $request->detail_sess_nama;
        $session_id     = $request->detail_sess_id;
        $id_product     = $request->barang_id;
        $qty            = $request->qty;
        // session::put('sess_nama', 'test message 1');
        // dd(Session::get('sess_nama'));
        $data_cek = OrderModels::where([['no_order','=',$no_order],['id_product','=',$id_product]])->count();
        if ($data_cek>0) {
            $msg = 'Tidak bisa input produk yang sama';
            return response()->json(['success' => false, 'message' => $msg]);
        }else{
            $order_save                  = new OrderModels();
            $order_save->no_order        = $no_order;
            $order_save->tgl_order       = Date('Y-m-d', strtotime($tgl_order));
            $order_save->id_user         = $session_id;
            $order_save->id_paket      = $id_product;
            $order_save->qty             = $qty;
            $order_save->status          = 1;
            $order_save->status_product  = 1;
            $order_save->user_at         = $session_user;

            $order_save->save();
            
            $msg = 'Data berhasil di simpan';
            return response()->json(['success' => true, 'message' => $msg]);
        }
    }

    public function update(Request $request)
    {

    }

    public function destroy_hdr(Request $request)
    {
        OrderModels::where('no_order', $request->no_order)->delete();
        $msg = 'Data berhasil di hapus';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function destroy_dtl(Request $request)
    {
        OrderModels::where('id', $request->id)->delete();
        $msg = 'Data berhasil di hapus';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function proses_po(Request $request)
    {
        if($request->f_status==1){
            $data = [
                'status'  => 2
            ];
        }elseif($request->f_status==2){
            $data = [
                'status'  => 3
            ];
        }else{
            $data = [
                'status'  => 4
            ];
        }
        

        OrderModels::where('no_order', $request->no_order)->update($data);

        $data_order = DB::table('qview_order_dtl')
                    ->where('no_order', $request->no_order)
                    ->get();
        
        $harga = 0;
        $total = 0;
        if($request->diskon){
            $diskon = $request->diskon;
        }else{
            $diskon = 0;
        }
        
        foreach ($data_order as $value) {
            $harga = $value->harga;
            $total = floatval($total) + floatval($harga);
            $id_user = $value->id_user;
        }

        if($request->f_status==1){
            $year = date('Y');
            $month = date('m');
            $last_doc_no = Helper::create_doc_no('PAYMENT', $month, $year);
            $no_payment = 'INV-'.Helper::right($year, 2) . $month . "-" .Helper::right("0000" . $last_doc_no, 4);
            // $no_payment = 'INV-2215-0001';

            $payment                    = new PaymentModels();

            $payment->no_payment        = $no_payment;
            $payment->tgl_payment       = date('Y-m-d');
            $payment->total_payment     = $total;
            $payment->total_diskon      = $diskon;
            $payment->id_user           = $request->sess_id;
            // $payment->id_order          = $id_order;
            $payment->no_order          = $request->no_order;
            $payment->status            = 0;
            $payment->user_at           = $request->sess_nama;

            $payment->save();
        }

        $msg = 'Data berhasil di hapus';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function get_total(Request $request)
    {
        $no_order = $request->no_order;
        $cek_barang = DB::table('qview_order_dtl')->where('no_order',$no_order)->count();
        $cek_paket = DB::table('qview_order_dtl_paket')->where('no_order',$no_order)->count();

        if($cek_barang>0 && $cek_paket>0){
            $order_barang = DB::table('qview_order_dtl')
                                ->select(DB::raw('sum(harga) as total'))
                                ->where('no_order',$no_order);
            $order_paket = DB::table('qview_order_dtl_paket')
                                ->select(DB::raw('sum(harga) as total'))
                                ->where('no_order',$no_order)
                                ->union($order_barang)
                                ->first();
        }elseif($cek_barang>0 && $cek_paket==0){
            $order_paket = DB::table('qview_order_dtl')
                                ->select(DB::raw('sum(harga) as total'))
                                ->where('no_order',$no_order)
                                ->first();
        }else{
            $order_paket = DB::table('qview_order_dtl_paket')
                                ->select(DB::raw('sum(harga) as total'))
                                ->where('no_order',$no_order)
                                ->first();
        }
        $total = $order_paket->total;

        $cek_schedule = DB::table('ttrx_schedule')->where('no_order',$no_order)->count();
        
        return response()->json(['total' => $total, 'jadwal' => $cek_schedule]);
    }
}
