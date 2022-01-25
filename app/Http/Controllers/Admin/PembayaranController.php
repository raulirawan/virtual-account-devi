<?php

namespace App\Http\Controllers\Admin;

use App\Pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::orderBy('harga','asc')->get();
        return view('Admin.pembayaran.index', compact('pembayaran'));
    }

    public function store(Request $request)
    {

        $pembayaran = new Pembayaran;

        $pembayaran->nama = $request->nama;
        $pembayaran->harga = $request->harga;

        $pembayaran->save();

        if($pembayaran != null) {
            return redirect()->route('admin.pembayaran.index')->with('success','Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.pembayaran.index')->with('error','Data Gagal di Tambah');
        }
    }

    public function update(Request $request, $id)
    {

        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->nama = $request->nama;
        $pembayaran->harga = $request->harga;

        $pembayaran->save();

        if($pembayaran != null) {
            return redirect()->route('admin.pembayaran.index')->with('success','Data Berhasil di Update');
        } else {
            return redirect()->route('admin.pembayaran.index')->with('error','Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->delete();
        if($pembayaran != null) {
            return redirect()->route('admin.pembayaran.index')->with('success','Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.pembayaran.index')->with('error','Data Gagal di Hapus');
        }
    }

}
