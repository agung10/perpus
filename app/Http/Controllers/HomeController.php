<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Siswa;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['bukus']  = Buku::get();
        $data['siswas'] = Siswa::get();
        $data['transaksis'] = Transaksi::get();
        
        return view('home', $data);
    }
}
