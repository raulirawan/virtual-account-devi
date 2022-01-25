<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                if ($request->from_date === $request->to_date) {
                    $query  = Transaction::with(['siswa'])
                        ->whereDate('created_at', $request->from_date)
                        ->where('status', 'SUCCESS')
                        ->latest();
                } else {
                    $query  = Transaction::with(['siswa'])
                        ->whereBetween('created_at', [$request->from_date, $request->to_date])
                        ->where('status', 'SUCCESS')
                        ->latest();
                }
            } else {
                $today = date('Y-m-d');
                $query  = Transaction::with(['siswa'])
                    ->whereDate('created_at', $today)
                    ->where('status', 'SUCCESS')
                    ->latest();
            }

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '<a href="'. route('admin.laporan.detail', $item->id) .'" class="btn-sm btn-info"><i class="fas fa-eye"></i>Detail</a>';
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->format('d-m-Y');
                })
                ->editColumn('status', function ($item) {
                    return '<span class="badge badge-success">SUKSES</span>';
                })
                ->rawColumns(['action','status'])
                ->make();
        }

        return view('admin.laporan.index');
    }

    public function detail($id)
    {
        $transaksi_siswa = Transaction::where('id', $id)->first();


        if (request()->ajax()) {

            $transaksi_detail = TransactionDetail::with(['pembayaran','transaksi'])
                                ->where('transaction_id', $id)
                                ->get();


            return DataTables::of($transaksi_detail)
                ->make();
        }

        return view('Admin.laporan.detail', compact('transaksi_siswa'));
    }
}
