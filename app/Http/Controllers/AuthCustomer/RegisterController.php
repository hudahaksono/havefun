<?php

namespace App\Http\Controllers\AuthCustomer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\UserModels;
use DateTime;
use DB;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register-customer');
    }
    public function postregistercustomer(Request $request)
    {
        if ($request->nama == "") {
            return redirect('/register-customer')->with('alert-name', 'Name Tidak Boleh Kosong');
        } elseif ($request->email == "") {
            return redirect('/register-customer')->with('alert-email', 'email Tidak Boleh Kosong');
        } elseif ($request->no_tlp == "") {
            return redirect('/register-customer')->with('alert-no_tlp', 'email Tidak Boleh Kosong');
        } elseif ($request->password == "") {
            return redirect('/register-customer')->with('alert-password', 'Password Tidak Boleh Kosong');
        } elseif ($request->repassword == "") {
            return redirect('/register-customer')->with('alert-password2', 'Ulangi Password Tidak Boleh Kosong');
        } elseif ($request->password <> $request->password2) {
            return redirect('/register-customer')->with('alert-salah', 'Password is Not The Same As Repeat Password');
        } else {
            $data =  new UserModels();
            $data->nama = $request->nama;
            $data->no_tlp = $request->no_tlp;
            $data->email = $request->email;
            $data->jabatan = 1;
            $data->password = bcrypt($request->password);
            $data->status_hapus = 5;
            $data->created_at = now();
            $data->save();
            return redirect('/login-customer')->with('alert-success', 'Registrasi Berhasil Silahkan Melakukan Login');
        }
    }
}
