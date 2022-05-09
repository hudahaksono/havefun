<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Auth\UserModels;

use Datatables;
use Redirect, Response;
use DateTime;
use DB;
use Illuminate\Contracts\Session\Session;

class MasterAksesController extends Controller
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
        $user_baru = DB::table('mst_users')
            ->select(DB::raw('nama,timediff("' . $date_now . '",created_at) as selisih '))
            ->where('created_at', '>=', $date)
            ->get();

        return view('office.master-akses', compact('order_baru', 'pembayaran', 'user_baru'));
    }

    public function list_data(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'email',
            3 => 'nama',
            4 => 'jabatan',
            5 => 'no_tlp',
            6 => 'action'
        );

        $totalData = DB::table('mst_users')
            ->where('status_hapus', '=', 0)
            ->where('jabatan', '=', 2)
            ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = DB::table('mst_users')
                ->offset($start)
                ->limit($limit)
                ->where('status_hapus', 0)
                ->where('jabatan', '=', 2)
                ->orderBy('id')
                ->get();
        } else {
            $search = $request->input('search.value');

            $posts =  DB::table('mst_users')
                ->offset($start)
                ->limit($limit)
                ->where([['status_hapus', '=', 0], ['nama', 'LIKE', "%{$search}%"]])
                ->orWhere([['status_hapus', '=', 0], ['email', 'LIKE', "%{$search}%"]])
                ->orWhere([['status_hapus', '=', 0], ['jabatan', 'LIKE', "%{$search}%"]])
                ->orderBy('id')
                ->get();

            $totalFiltered = DB::table('mst_users')
                ->where([['status_hapus', '=', 0], ['nama', 'LIKE', "%{$search}%"]])
                ->orWhere([['status_hapus', '=', 0], ['email', 'LIKE', "%{$search}%"]])
                ->orWhere([['status_hapus', '=', 0], ['jabatan', 'LIKE', "%{$search}%"]])
                ->count();
        }

        $data = array();
        $i = $start + 1;
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['id'] = $post->id;
                $nestedData['DT_RowIndex'] = $i;
                $nestedData['email'] = $post->email;
                $nestedData['nama'] = $post->nama;
                $nestedData['no_tlp'] = $post->no_tlp;
                $nestedData['action'] = "&nbsp;<a href='javascript:void(0)' id='accept' data-toggle='tooltip' title='Accept' data-id='$post->id' data-original-title='' class='Accept btn btn-info btn-sm'><i class='fas fa-check'></i> &nbsp;Accept</a>
                                        <a href='javascript:void(0)' id='reject' data-toggle='tooltip' title='Reject' data-id='$post->id' data-original-title='' class='Reject btn btn-danger btn-sm'><i class='fas fa-times-circle'></i> &nbsp;Reject</a>";
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

    public function accept($id)
    {
        $date_time = new DateTime;
        $data = [
            'jabatan' => 3,
            'updated_at' => $date_time
        ];
        UserModels::where('id', $id)->update($data);
        $msg = 'Data berhasil di hapus';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function reject($id)
    {
        $date_time = new DateTime;
        $data = [
            'status_hapus' => 1,
            'updated_at' => $date_time
        ];
        UserModels::where('id', $id)->update($data);
        $msg = 'Data berhasil di hapus';
        return response()->json(['success' => true, 'message' => $msg]);
    }
}
