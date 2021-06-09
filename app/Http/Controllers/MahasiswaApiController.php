<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listmahasiswa = Mahasiswa::all();
        return $listmahasiswa ;
        //response()->json([
          //  "data" => $listmahasiswa
        //]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // cara 1
        // $mahasiswa = new Mahasiswa();
        // $mahasiswa->npm = $request->npm; // sama dengan $_POST['npm']
        // $mahasiswa->nama_mahasiswa = $request->nama_mahasiswa;
        // $mahasiswa->tempat_lahir = $request->tempat_lahir;
        // $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        // $mahasiswa->alamat = $request->alamat;
        // $mahasiswa->save();
        
        //cara 2 mass assignment (atur fillable di models
        $mahasiswa = Mahasiswa::create($request->all());
        return response()->json([
            'status' => true,
            'message' => "Mahasiswa berhasil disimpan"
        ]);

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
        // $result = [
        //     "status" => false,
        //     "message" => "Data tidak ditemukan"
        // ]
        // $mahasiswa = Mahasiswa::find($id);
        // if($mahasiswa){
        //     $result = [
        //         "status" => true,
        //         "data" => $mahasiswa
        //     ];
        // }
        // return response()->json($result);

        // $mahasiswa = Mahasiswa::findOrFail($id);

        //pake find
        $mahasiswa = Mahasiswa::find($id);
        if($mahasiswa){
            return response()->json([
                'status' => true,
                'data' => $mahasiswa
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => "Data tidak ditemukan"
        ]);
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
        //
        // $mahasiswa = Mahasiswa::find($id);
        // $mahasiswa->npm = $request->npm; // sama dengan $_POST['npm']
        // $mahasiswa->nama_mahasiswa = $request->nama_mahasiswa;
        // $mahasiswa->tempat_lahir = $request->tempat_lahir;
        // $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        // $mahasiswa->alamat = $request->alamat;
        // $mahasiswa->save();

        $mahasiswa = Mahasiswa::findOrFail($id);
        if($mahasiswa){
            $mahasiswa->update($request->all());
            return response()->json([
                'status' => true,
                'data' => Mahasiswa::find($id),
                'message' => "Data Berhasil diupdate",
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => "Data gagal diupdate",
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $mahasiswa = Mahasiswa::find($id);
        if($mahasiswa){
            $mahasiswa->delete();
            return response()->json([
                'status' => true,
                'message' => "Data Berhasil dihapus",
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => "Data gagal dihapus",
        ]);
    }
}
