<?php

namespace App\Http\Controllers\Admin;

use App\Jurusan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::orderBy('nama_jurusan','asc')->get();
        return view('Admin.jurusan.index', compact('jurusan'));
    }

    public function store(Request $request)
    {

        $jurusan = new Jurusan;

        $jurusan->nama_jurusan = $request->jurusan;

        $jurusan->save();

        if($jurusan != null) {
            return redirect()->route('admin.jurusan.index')->with('success','Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.jurusan.index')->with('error','Data Gagal di Tambah');
        }
    }

    public function update(Request $request, $id)
    {

        $jurusan = Jurusan::findOrFail($id);

        $jurusan->nama_jurusan = $request->jurusan;

        $jurusan->save();

        if($jurusan != null) {
            return redirect()->route('admin.jurusan.index')->with('success','Data Berhasil di Update');
        } else {
            return redirect()->route('admin.jurusan.index')->with('error','Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $jurusan->delete();
        if($jurusan != null) {
            return redirect()->route('admin.jurusan.index')->with('success','Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.jurusan.index')->with('error','Data Gagal di Hapus');
        }
    }

}
