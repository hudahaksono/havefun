<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\UserModels;
use DateTime;
use DB;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function postregister(Request $request)
    {
        if ($request->name == "") {
            return redirect('/register')->with('alert-name', 'Name Cannot Be Empty');
        } elseif ($request->email == "") {
            return redirect('/register')->with('alert-email', 'email Cannot Be Empty');
        } elseif ($request->no_tlp == "") {
            return redirect('/register')->with('alert-no_tlp', 'email Cannot Be Empty');
        } elseif ($request->password == "") {
            return redirect('/register')->with('alert-password', 'Password Cannot Be Empty');
        } elseif ($request->password2 == "") {
            return redirect('/register')->with('alert-password2', 'Repeat Password Cannot Be Empty');
        } elseif ($request->password <> $request->password2) {
            return redirect('/register')->with('alert-salah', 'Password is Not The Same As Repeat Password');
        } else {
            $data =  new UserModels();
            $data->nama = $request->name;
            $data->no_tlp = $request->no_tlp;
            $data->email = $request->email;
            $data->jabatan = 1;
            $data->password = bcrypt($request->password);
            $data->status_hapus = 0;
            $data->created_at = now();
            $data->save();
            return redirect('/login')->with('alert-success', 'Registration Is Successful Please Login');
        }
    }
}
