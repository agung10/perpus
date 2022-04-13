<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['siswas'] = Siswa::orderBy('id', 'DESC')->get();
        return view('siswa.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.create');
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
            "nis" => "required|unique:siswas|max:7",
            "nama" => "required|string|max:30",
            "jk" => "required"
        ]);

        $data = new Siswa();
        $data->nis = $request->input('nis');
        $data->nama = $request->input('nama');
        $data->jk = $request->input('jk');

        $data->save();

        return redirect()->route('siswa.index')->with("alertStore", "Data {$data->nama}");
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
        $data['siswa'] = Siswa::find($id);
        return view('siswa.edit', $data);
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
        $request->validate([
            "nama" => "required|string|max:30",
            "jk" => "required"
        ]);

        $data = Siswa::find($id);
        $data->nis = $request->input('nis');
        $data->nama = $request->input('nama');
        $data->jk = $request->input('jk');

        $data->save();

        return redirect()->route('siswa.index')->with("alertUpdate", "Data {$data->nama}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Siswa::find($id);
        $data->delete();

        $nama = $data->nama;
        return redirect()->route('siswa.index')->with("alertDestroy", "Data {$nama}");
    }
}
