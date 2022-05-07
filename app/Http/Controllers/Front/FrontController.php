<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Helper;
use Redirect, Response, DB;

class FrontController extends Controller
{
    public function index()
    {
        $banner = DB::table('tmst_banner')->get();
        return view('front.index', compact('banner'));
    }
}
