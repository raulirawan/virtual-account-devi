<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Kelas;
use App\Jurusan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $siswa = User::with(['kelas','jurusan'])->where('roles','SISWA')->get();
        return view('Admin.siswa.index', compact('siswa','kelas','jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'unique:users'
        ]);

        $siswa = new User;

        $siswa->nisn = $request->nisn;
        $siswa->name = $request->name;
        $siswa->kelas_id = $request->kelas;
        $siswa->jurusan_id = $request->jurusan;
        $siswa->password = bcrypt($request->password);
        $siswa->email = $request->email;
        $siswa->alamat = $request->alamat;

        $siswa->save();

        if($siswa != null) {
            return redirect()->route('admin.siswa.index')->with('success','Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.siswa.index')->with('error','Data Gagal di Tambah');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nisn' => 'unique:users,id'
        ]);

        $siswa = User::findOrFail($id);

        $siswa->nisn = $request->nisn;
        $siswa->name = $request->name;
        $siswa->email = $request->email;
        $siswa->alamat = $request->alamat;

        $siswa->save();

        if($siswa != null) {
            return redirect()->route('admin.siswa.index')->with('success','Data Berhasil di Update');
        } else {
            return redirect()->route('admin.siswa.index')->with('error','Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $siswa = User::findOrFail($id);

        $siswa->delete();
        if($siswa != null) {
            return redirect()->route('admin.siswa.index')->with('success','Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.siswa.index')->with('error','Data Gagal di Hapus');
        }
    }

}
