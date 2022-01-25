<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $sukses = Transaction::where('user_id', Auth::user()->id)->where('status','SUCCESS')->count();
        $pending = Transaction::where('user_id', Auth::user()->id)->where('status','PENDING')->count();
        $gagal = Transaction::where('user_id', Auth::user()->id)->whereNotIn('status',['PENDING','SUCCESS'])->count();
        return view('pages.dashboard', compact('sukses','pending','gagal'));
    }
}
