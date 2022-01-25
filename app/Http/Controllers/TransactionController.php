<?php

namespace App\Http\Controllers;

use Exception;
use Midtrans\Snap;
use App\Transaction;
use Midtrans\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transaksi = Transaction::where('user_id', Auth::user()->id)->where('is_active', 1)->get();
        return view('pages.transaksi.index', compact('transaksi'));
    }

    public function siswaBayar(Request $request, $id)
    {
        //ser konfigurasi midtrans
        $transaction = Transaction::findOrFail($id);
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');


        //Buat Array Untuk Kirim API MIDTRANS
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => $transaction->kode,
                'gross_amount' => (int) $transaction->total_harga,
            ],

            'customer_details' => [
                'first_name' => $transaction->siswa->name,
                'email' => $transaction->siswa->email,
            ],

            'enable_payments' => ['bca_va','permata_va','bni_va','bri_va'],
            'vtweb' => [],
        ];

        try {
            //ambil halaman payment midtrans
            $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;

            $transaction->payment_url = $paymentUrl;
            $transaction->save();
            //reditect halaman midtrans
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
