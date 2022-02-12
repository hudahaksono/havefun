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

class MasterUserController extends Controller
{
    public function index()
    {
        return view('office.master-user');
    }

    public function list_data(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'email',
            3 => 'nama',
            4 => 'jabatan',
            5 => 'action'
        );

        $totalData = DB::table('mst_users')
            ->where('status_hapus', '=', 0)
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
                $nestedData['jabatan'] = $post->jabatan;
                $nestedData['role'] = 'Admin';
                $nestedData['action'] = "&nbsp;<a href='javascript:void(0)' id='edit' data-toggle='tooltip' title='Edit' data-id='$post->id' data-original-title='' class='Edit btn btn-info btn-sm'><i class='fas fa-edit'></i> &nbsp; Edit</a>
                                        <a href='javascript:void(0)' id='delete' data-toggle='tooltip' title='Delete' data-id='$post->id' data-original-title='' class='Delete btn btn-danger btn-sm'><i class='fas fa-times-circle'></i> &nbsp; Hapus</a>";
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
        $data =  new UserModels();
        // $data->nip = $request->nip;
        $data->nama = $request->name;
        $data->email = $request->email;
        // $data->id_unit_kerja = $request->unit;
        // $data->id_jabatan = $request->jabatan;
        $data->status_hapus = 0;
        // $data->username = 'admin';
        $data->password = bcrypt('admin');
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
            'updated_at'  => $date
        ];

        UserModels::where('id', $request->sysid)->update($data);
        $msg = 'Data berhasil di ubah';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        UserModels::where('id', $id)->delete();
        $msg = 'Data berhasil di hapus';
        return response()->json(['success' => true, 'message' => $msg]);
    }
}
