<?php

namespace App\Http\Controllers;
use App\ModelKontak;
use Validator;

use Illuminate\Http\Request;

class Login extends Controller
{
    public function index()
    {
        return view('login');
    }
    
    public function cek(Request $req)
    {
        $this->validate($req,[
            'username' => 'required',
            'password' => 'required'
        ]);
        $proses=ModelKontak::where('username', $req->username)->where('password', $req->password)->first();
        if ($proses!="") {
            Session::put('id_kontak', $proses->id_kontak);
            Session::put('username', $proses->username);
            Session::put('password', $proses->password);
            Session::put('nama', $proses->nama);
            Session::put('login_status', true);
            return redirect('/kontak');
        } else{ 
            // Session::flash('alert_pesan', 'Username atau Password salah');
            return redirect('login');
        }
    }
}
