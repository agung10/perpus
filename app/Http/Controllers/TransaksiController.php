<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\JenisBuku;
use App\Models\Siswa;
use App\Models\Transaksi;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['transaksis'] = Transaksi::orderBy('id', 'DESC')->get();
        $data['jenis_bukus'] = JenisBuku::select('jenis')->get();

        return view('transaksi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getRow = Transaksi::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $data['kodeTransaksi'] = "TR00001";
        
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $data['kodeTransaksi'] = "TR0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $data['kodeTransaksi'] = "TR000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $data['kodeTransaksi'] = "TR00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $data['kodeTransaksi'] = "TR0".''.($lastId->id + 1);
            } else {
                    $data['kodeTransaksi'] = "TR".''.($lastId->id + 1);
            }
        }

        $data['bukus'] = Buku::all();
        $data['siswas'] = Siswa::all();

        return view('transaksi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "kode_transaksi" => 'required',
            "tgl_pinjam" => 'required',
            "buku_id" => 'required',
            "siswa_id" => 'required',
        ]);

        $data = new Transaksi();
        $data->kode_transaksi = $request->input('kode_transaksi');
        $data->tgl_pinjam = $request->input('tgl_pinjam');
        $data->buku_id = $request->input('buku_id');
        $data->siswa_id = $request->input('siswa_id');

        $data->save();

        return redirect()->route('transaksi.index')->with("alertStore", "Data {$data->kode_transaksi}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Transaksi::find($id);
        $data->kode_transaksi = $request->input('kode_transaksi');
        $data->tgl_pinjam = $request->input('tgl_pinjam');
        $data->tgl_kembali = $request->input('tgl_kembali');
        $data->denda = $request->input('denda');
        $data->status = 'kembali';

        $data->save();

        return redirect()->route('transaksi.index')->with("alertUpdate", "Data {$data->kode_transaksi}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Transaksi::find($id);
        $data->delete();

        $kode_transaksi = $data->kode_transaksi;
        return redirect()->route('transaksi.index')->with("alertDestroy", "Data {$kode_transaksi}");
    }

    public function getDataKembali($id)
    {
        $data = Transaksi::with('buku.jenis_buku', 'siswa')->find($id);
        
        $data->tgl_kembali = Carbon::now()->addDays(3)->format('Y-m-d');
        $selisih = strtotime($data->tgl_kembali) - strtotime($data->tgl_pinjam);
        $hari = abs(round($selisih / 86400));
        $data->telat = $hari - 3;

        $denda = $hari > 3 ? ($data->telat * $data->buku->jenis_buku->denda) : 0;
        
        $data->denda = $denda;

        return response()->json($data);
    }
}
