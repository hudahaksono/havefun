<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Auth\UserModels;
use DateTime;
use DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        $data = UserModels::where('email', $request->email)->first();
        if ($data === null) {
            return redirect('/')->with('alert-nofind', 'Unregistered Account');
        } else {
            if ($data->jabatan == 1) {
                if ($data->status_hapus == '0') {
                    if (Hash::check($request->password, $data->password)) {
                        session::put('sess_email', $data->email);
                        session::put('sess_nama', $data->nama);
                        session::put('sess_jabatan', $data->id_golongan);
                        session(['berhasil_login' => true]);
                        return redirect('/menu');
                    } else {
                        return redirect('/login')->with('alert-wrong', 'Wrong Password');
                    }
                    return redirect('/login')->with('alert-confirm', 'Your account has not been confirmed, please contact the admin');
                }
            } else {
                return redirect('/login')->with('alert-noaccess', 'Access Denied');
            }
            return redirect('/login')->with('alert-nofind', 'Unregistered Account');
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/')->with('alert-logout', 'Anda Berhasil Logout');
    }
}