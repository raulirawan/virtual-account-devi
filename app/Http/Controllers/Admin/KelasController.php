<?php

namespace App\Http\Controllers\Admin;

use App\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::orderBy('kelas','asc')->get();
        return view('Admin.kelas.index', compact('kelas'));
    }

    public function store(Request $request)
    {

        $kelas = new Kelas;

        $kelas->kelas = $request->kelas;

        $kelas->save();

        if($kelas != null) {
            return redirect()->route('admin.kelas.index')->with('success','Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.kelas.index')->with('error','Data Gagal di Tambah');
        }
    }

    public function update(Request $request, $id)
    {

        $kelas = Kelas::findOrFail($id);

        $kelas->kelas = $request->kelas;

        $kelas->save();

        if($kelas != null) {
            return redirect()->route('admin.kelas.index')->with('success','Data Berhasil di Update');
        } else {
            return redirect()->route('admin.kelas.index')->with('error','Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();
        if($kelas != null) {
            return redirect()->route('admin.kelas.index')->with('success','Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.kelas.index')->with('error','Data Gagal di Hapus');
        }
    }

}
