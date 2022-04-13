<?php

namespace App\Http\Controllers;

use App\Models\JenisBuku;
use Illuminate\Http\Request;

class JenisBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['jenis_bukus'] = JenisBuku::orderBy('id', 'DESC')->get();
        return view('buku.jenis_buku', $data);
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
            "jenis" => "required|string"
        ]);

        $data = new JenisBuku();
        $data->jenis = $request->input('jenis');

        $data->save();

        return redirect()->route('jenis_buku.index')->with("alertStore", "Data {$data->jenis}");
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
        $data = JenisBuku::find($id);
        $data->jenis = $request->input('jenis');

        $data->save();

        return redirect()->route('jenis_buku.index')->with("alertUpdate", "Data {$data->jenis}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = JenisBuku::find($id);
        $data->delete();

        $jenis = $data->jenis;
        return redirect()->route('jenis_buku.index')->with("alertDestroy", "Data {$jenis}");
    }

    public function getDataEdit($id)
    {
        $data = JenisBuku::find($id);
        return response()->json($data);

        // echo json_encode($data); native;
    }
}
