<?php

namespace App\Http\Controllers\AuthCustomer;

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
        return view('login-customer');
    }

    public function postlogincustomer(Request $request)
    {
        $data = UserModels::where('email', $request->email)->first();
        if ($data === null) {
            return redirect('/login')->with('alert-nofind', 'Akun Tidak Ditemukan');
        } else {
            if ($data->jabatan == 1) {
                if ($data->status_hapus == '0') {
                    if (Hash::check($request->password, $data->password)) {
                        session::put('sess_id', $data->id);
                        session::put('sess_email', $data->email);
                        session::put('sess_nama', $data->nama);
                        session::put('sess_no_tlp', $data->no_tlp);
                        session::put('sess_jabatan', $data->jabatan);
                        session(['berhasil_login' => true]);
                        return redirect('/');
                    } else {
                        return redirect('/login-customer')->with('alert-wrong', 'Password Salah');
                    }
                } else {
                    return redirect('/login-customer')->with('alert-noaccess', 'Akun sudah dihapus');
                }
            } else {
                return redirect('/login-customer')->with('alert-nofind', 'Akun anda belum dikonfirmasi via email');
            }
        }
    }

    public function logoutcustomer(Request $request)
    {
        Session::flush();
        return redirect('/')->with('alert-logout', 'Anda Berhasil Logout');
    }
}
