<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaketModels;

use Datatables;
use Redirect, Response;
use DateTime;
use DB;

class PaketController extends Controller
{
    public function index()
    {

        return view('office.paket.master-paket');
    }

    public function list_data_hdr(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'DT_RowIndex',
            2 => 'nama',
            3 => 'keterangan',
            4 => 'action'
        );

        $totalData = DB::table('tmst_kategori')
            ->where('status_hapus', '=', 0)
            ->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = DB::table('tmst_paket')
                ->offset($start)
                ->limit($limit)
                ->where('status_hapus', '=', 0)
                ->orderBy('nama')
                ->get();
        } else {
            $search = $request->input('search.value');

            $posts =  DB::table('tmst_paket')
                ->offset($start)
                ->limit($limit)
                ->Where([['status_hapus', '=', 0], ['nama', 'LIKE', "%{$search}%"]])
                ->orderBy('nama')
                ->get();

            $totalFiltered = DB::table('tmst_paket')
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
                $nestedData['action'] = "&emsp;<a href='javascript:void(0)' id='edit_data_hdr' data-toggle='tooltip' title='Edit' data-id='$post->id' data-original-title='' class='Edit btn btn-warning btn-sm'><i class='fas fa-pencil-alt'></i> &nbsp; Edit </a>
                                        <a href='javascript:void(0)' id='delete_data_hdr' data-toggle='tooltip' title='Delete' data-id='$post->id' data-original-title='' class='Delete btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i> &nbsp; Hapus </a>";
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
        $grup_kategori    = PaketModels::where('nama', $request->nama)->first();

        if ($grup_kategori === NULL) {
            $data_hdr['nama']           = $request->nama;
            $data_hdr['keterangan']     = $request->keterangan;
            $data_hdr['status_hapus']   = '0';
            $data_hdr['created_at']     = now();

            PaketModels::create($data_hdr);

            $msg = 'Data berhasil di simpan';
            return response()->json(['success' => true, 'message' => $msg]);
        } else {
            $msg = 'Kode Barang Sudah Terdaftar';
            return response()->json(['warning' => true, 'message' => $msg]);
        }
    }

    public function update(Request $request)
    {
        $data = [
            'nama'          => $request->nama,
            'keterangan'    => $request->keterangan,
        ];

        PaketModels::where('id', $request->sysid)->update($data);
        $msg = 'Data berhasil di ubah';
        return response()->json(['success' => true, 'message' => $msg]);
    }

    public function destroy(Request $request)
    {
        $data = [
            'status_hapus'  => 1,
        ];

        PaketModels::where('id', $request->id)->update($data);
        $msg = 'Data berhasil di hapus';
        return response()->json(['success' => true, 'message' => $msg]);
    }
}
