<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Auth\UserModels;
use DateTime;
use DB;

class MenuController extends Controller
{
    public function index()
    {
        return view('office.dashboard');
    }
}
