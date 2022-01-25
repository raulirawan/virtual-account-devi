<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Pembayaran;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    public function index()
    {
        $siswas = User::where('roles','SISWA')->get();
        $pembayaran = Pembayaran::all();
        $transaksi = Transaction::orderBy('created_at','desc')->get();
        return view('Admin.transaksi.index', compact('transaksi', 'pembayaran','siswas'));
    }

    public function active($id)
    {
        $transaksi = Transaction::findOrFail($id);
        $transaksi->is_active = 1;
        $transaksi->save();

        if($transaksi != null) {
            return redirect()->back()->with('success','Data Berhasil di Aktifkan');
        } else {
            return redirect()->back()->with('error','Data Gagal di Aktifkan');
        }
    }

    public function nonActive($id)
    {
        $transaksi = Transaction::findOrFail($id);
        $transaksi->is_active = 0;
        $transaksi->save();

        if($transaksi != null) {
            return redirect()->back()->with('success','Data Berhasil di Non Aktifkan');
        } else {
            return redirect()->back()->with('error','Data Gagal di Non Aktifkan');
        }
    }

    public function detail($id)
    {
        $pembayaran = Pembayaran::all();
        $transaksi_siswa = Transaction::where('id', $id)->first();


        if (request()->ajax()) {

            $transaksi_detail = TransactionDetail::with(['pembayaran','transaksi'])
                                ->where('transaction_id', $id)
                                ->get();


            return DataTables::of($transaksi_detail)
                ->addColumn('action', function ($item) {
                    return '<a href="'.route('admin.transaksi.detail.hapus', $item->id).'" class="btn-sm btn-danger" onclick="return confirm('."'Yakin ?'".') "></i>Hapus</a>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('Admin.transaksi.detail', compact('transaksi_siswa','pembayaran'));
    }

    public function hapus($id)
    {
        $transaksi_detail = TransactionDetail::findOrFail($id);

        $transaksi_siswa = Transaction::findOrFail($transaksi_detail->transaksi->id);
        $harga = $transaksi_detail->pembayaran->harga;

        $total_harga = $transaksi_siswa->total_harga - $harga;

        $transaksi_siswa->total_harga = $total_harga;
        $transaksi_siswa->save();


        $transaksi_detail->delete();

        if($transaksi_detail != null) {
            return redirect()->route('admin.transaksi.detail', $transaksi_siswa->id)->with('success','Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.transaksi.detail', $transaksi_siswa->id)->with('error','Data Gagal di Hapus');
        }
    }

    public function storeDetail(Request $request, $id)
    {
        $harga = Pembayaran::where('id', $request->pembayaran)->first()->harga;

        $transaksi_siswa = Transaction::findOrFail($id);

        $total_harga = $transaksi_siswa->total_harga + $harga;

        $transaksi_siswa->total_harga = $total_harga;
        $transaksi_siswa->save();

        $transaksi_detail = new TransactionDetail;
        $transaksi_detail->transaction_id = $id;
        $transaksi_detail->pembayaran_id = $request->pembayaran;
        $transaksi_detail->harga = $harga;
        $transaksi_detail->save();

        if($transaksi_detail != null) {
            return redirect()->route('admin.transaksi.detail', $id)->with('success','Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.transaksi.detail', $id)->with('error','Data Gagal di Tambah');
        }
    }

    public function globalPost(Request $request)
    {
        $siswa = User::where('roles','SISWA')->get();

        $pembayaran = $request->pembayaran;

        // hitung total_harga
        $total_harga = 0;
        foreach ($pembayaran as $pbr) {
            $data_pembayaran = Pembayaran::find($pbr);

            $total_harga += $data_pembayaran->harga;
        }

        foreach ($siswa as $item) {
            $kode = 'TRX-'.mt_rand(0000000,9999999);

            $transaksi = new Transaction;
            $transaksi->user_id = $item->id;
            $transaksi->kode = $kode;
            $transaksi->status = 'PENDING';
            $transaksi->is_active = 0;
            $transaksi->total_harga = $total_harga;
            $transaksi->save();

            foreach ($pembayaran as $pbyrn) {
                $pembayarannn = Pembayaran::find($pbyrn);

                $transaksi_detail = new TransactionDetail;

                $transaksi_detail->transaction_id = $transaksi->id;
                $transaksi_detail->pembayaran_id = $pbyrn;
                $transaksi_detail->harga = $pembayarannn->harga;
                $transaksi_detail->save();
            }
        }

        if($transaksi_detail != null) {
            return redirect()->route('admin.transaksi.index')->with('success','Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.transaksi.index')->with('error','Data Gagal di Tambah');
        }
    }

    public function addPostPerSiswa(Request $request)
    {
        $pembayaran = $request->pembayaran;

        // hitung total_harga
        $total_harga = 0;
        foreach ($pembayaran as $pbr) {
            $data_pembayaran = Pembayaran::find($pbr);

            $total_harga += $data_pembayaran->harga;
        }
        $kode = 'TRX-'.mt_rand(0000000,9999999);

        $transaksi = new Transaction;
        $transaksi->user_id = $request->siswa;
        $transaksi->kode = $kode;
        $transaksi->status = 'PENDING';
        $transaksi->is_active = 0;
        $transaksi->total_harga = $total_harga;
        $transaksi->save();

        foreach ($pembayaran as $pbyrn) {
            $pembayarannn = Pembayaran::find($pbyrn);

            $transaksi_detail = new TransactionDetail;

            $transaksi_detail->transaction_id = $transaksi->id;
            $transaksi_detail->pembayaran_id = $pbyrn;
            $transaksi_detail->harga = $pembayarannn->harga;
            $transaksi_detail->save();
        }

        if($transaksi_detail != null) {
            return redirect()->route('admin.transaksi.index')->with('success','Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.transaksi.index')->with('error','Data Gagal di Tambah');
        }
    }
}
