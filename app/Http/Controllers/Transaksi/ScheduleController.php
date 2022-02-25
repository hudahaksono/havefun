<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScheduleModels;

use Datatables;
use Redirect, Response;
use DateTime;
use DB;

class ScheduleController extends Controller
{
	public function index()
    {
        return view('office.transaksi.tr-shcedule');
    }

    public function list_data_hdr(Request $request)
    {
    	$data = DB::table('ttrx_schedule')
    				->join('ttrx_order', 'ttrx_schedule.id_order', '=', 'ttrx_order.id')
    				->select('ttrx_schedule.*', 'ttrx_order.no_order')
    				->get();
        $listdata = array();
        foreach($data as $value){
            $parse['start'] = Date('Y-m-d', strtotime($value->tgl_dari));
            $parse['end'] = Date('Y-m-d', strtotime($value->tgl_sampai));
            $parse['title'] = $value->no_order.': '.$value->keterangan;
            // $parse['display'] = 'background';
            // $parse['color'] = '#ff9f89';
            $listdata[] = $parse;
        }
        $parse = [];
        foreach($data as $value){
            $parse['start'] = Date('Y-m-d', strtotime($value->tgl_dari));
            $parse['end'] = Date('Y-m-d', strtotime($value->tgl_sampai));
            // $parse['title'] = $value->no_order.': '.$value->keterangan;
            $parse['display'] = 'background';
            $parse['color'] = '#ff9f89';
            $listdata[] = $parse;
        }
        $parse = [];
        foreach($data as $value){
            $parse['start'] = Date('Y-m-d', strtotime($value->tgl_dari));
            $parse['end'] = Date('Y-m-d', strtotime($value->tgl_sampai));
            $parse['title'] = 'Lokasi : '.$value->tempat;
            $listdata[] = $parse;
        }
    	return response()->json($listdata);
    }
}