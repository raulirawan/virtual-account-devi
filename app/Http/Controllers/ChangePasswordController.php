<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('pages.change-password.index');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request,[
            'oldPassword' => 'required',
            'password' => 'required|confirmed',

            ]);

            if(!(Hash::check($request->get('oldPassword'), Auth::user()->password))){

                return redirect()->route('siswa.change.password.index')->with('error','Password Lama Anda Salah');

            }

            if(strcmp($request->get('oldPassword'), $request->get('password')) == 0){

                return redirect()->route('siswa.change.password.index')->with('error','Password Lama Anda Tidak Boleh Sama Dengan Password Baru');
            }

            $user = Auth::user();
            $user->password = bcrypt($request->get('password'));
            $user->save();

            return redirect()->route('siswa.change.password.index')->with('success','Password Anda Berhasil di Ganti');
    }
}
