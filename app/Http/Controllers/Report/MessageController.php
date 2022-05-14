<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\MessageModels;

use Datatables;
use Redirect, Response;
use DateTime;
use DB;
use Illuminate\Contracts\Session\Session;

class MessageController extends Controller
{
    public function index()
    {
        // date_default_timezone_set('Asia/Jakarta');
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
        $user_baru = DB::table('trpt_message')
            ->select(DB::raw('nama,timediff("' . $date_now . '",created_at) as selisih '))
            ->where('created_at', '>=', $date)
            ->get();

        return view('office.report.rpt-message', compact('order_baru', 'pembayaran', 'user_baru'));
    }

    public function list_data(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'nama',
            3 => 'email',
            4 => 'tanggal',
            5 => 'no_tlp',
            6 => 'pesan',
            7 => 'action'
        );

        $totalData = DB::table('trpt_message')
            ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = DB::table('trpt_message')
                ->offset($start)
                ->limit($limit)
                ->orderByDesc('id')
                ->get();
        } else {
            $search = $request->input('search.value');

            $posts =  DB::table('trpt_message')
                ->offset($start)
                ->limit($limit)
                ->where('nama', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('no_tlp', 'LIKE', "%{$search}%")
                ->orderByDesc('id')
                ->get();

            $totalFiltered = DB::table('trpt_message')
                ->where('nama', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('no_tlp', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();
        $i = $start + 1;
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['id'] = $post->id;
                $nestedData['DT_RowIndex'] = $i;
                $nestedData['nama'] = $post->nama;
                $nestedData['email'] = $post->email;
                $nestedData['no_tlp'] = $post->no_tlp;
                $nestedData['tanggal'] = $post->tanggal;
                $nestedData['pesan'] = $post->pesan;
                $nestedData['action'] = "&nbsp;<a href='javascript:void(0)' id='detail' data-toggle='tooltip' title='Detail' data-id='$post->id' data-original-title='' class='Detail btn btn-primary btn-sm'><i class='fas fa-book'></i>&nbsp; Isi Pesan</a>";
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
        $data =  new MessageModels();
        $data->nama = $request->name;
        $data->email = $request->email;
        $data->no_tlp = $request->no_tlp;
        $data->jabatan = $request->jabatan;
        $data->password = bcrypt('admin');
        $data->status_hapus = 0;
        $data->save();

        $msg = 'Data berhasil di simpan';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function update(Request $request)
    {
        $date = new DateTime;
        $data = [
            'nama'        => $request->name,
            'email'       => $request->email,
            'no_tlp'       => $request->no_tlp,
            'jabatan'       => $request->jabatan,
            'updated_at'  => $date
        ];

        MessageModels::where('id', $request->sysid)->update($data);
        $msg = 'Data berhasil di ubah';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function destroy($id)
    {
        $date_time = new DateTime;
        $data = [
            'status_hapus' => 1,
            'updated_at' => $date_time
        ];
        MessageModels::where('id', $id)->update($data);
        $msg = 'Data berhasil di hapus';
        return response()->json(['success' => true, 'message' => $msg]);
    }
}
