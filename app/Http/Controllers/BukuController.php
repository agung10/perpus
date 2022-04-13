<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\JenisBuku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['bukus'] = Buku::orderBy('id', 'DESC')->get();
        $data['jenis_bukus'] = JenisBuku::all();
        return view('buku.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            "kode_buku" => "required|unique:bukus",
            "judul_buku" => "required|string",
            "jenis_buku_id" => "required|string",
        ]);

        $data = new Buku();
        $data->kode_buku = $request->input('kode_buku');
        $data->judul_buku = $request->input('judul_buku');
        $data->jenis_buku_id = $request->input('jenis_buku_id');

        $data->save();

        return redirect()->route('buku.index')->with("alertStore", "Data {$data->kode_buku}");
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
        $data = Buku::find($id);
        $data->kode_buku = $request->input('kode_buku');
        $data->judul_buku = $request->input('judul_buku');
        $data->jenis_buku_id = $request->input('jenis_buku_id');

        $data->save();
        
        return redirect()->route('buku.index')->with("alertUpdate", "Data {$data->kode_buku}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Buku::find($id);
        $data->delete();

        $kode_buku = $data->kode_buku;
        return redirect()->route('buku.index')->with("alertDestroy", "Data {$kode_buku}");
    }

    public function getDataEdit($id)
    {
        $data = Buku::find($id);
        return response()->json($data);

        // echo json_encode($data); native;
    }
}
