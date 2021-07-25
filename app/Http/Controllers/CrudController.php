<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    //tampilkan data
    public function index(){
       $data_barang = DB::table('data_barang')->paginate(5);
        return view('crud', ['data_barang'=> $data_barang]);
    }

    //method menampilkan form tambah data
    public function tambah(){
        return view('crud-tambah-data');
    }

    //method simpan data ke DB
    public function simpan(Request $request){
        
        $validation = $request->validate([
            'kode_barang' => 'required|max:10|min:3',
            'nama_barang' => 'required'
        ],
        [
            'kode_barang.required' => 'Harus Diisi',
            'kode_barang.min' => 'Minimal 3 Huruf',
            'kode_barang.max' => 'Maximal 10 Huruf',
            'nama_barang.required' => 'Harus Diisi'
        ]);
        
        DB::insert('insert into varians (kode_barang, nama_barang) values (?, ?)', [$request->kode_barang, $request->nama_barang]);
        return redirect()->route('crud')->with('message', 'Data berhasil disimpan!');
    }

    //method hapus data ke DB
    public function delete($id){
        DB::table('data_barang')->where('id', $id)->delete();
        return redirect()->back()->with('message', 'Data berhasil dihapus!');
    }

    //method edit data ke DB
    public function edit($id){
       $data_barang = DB::table('data_barang')->where('id',$id)->first();
       return view('crud-edit-data', ['data_barang' => $data_barang]);
    }

    public function update(Request $request, $id){
        DB::table('data_barang')->where('id',$id)->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,]);
        return redirect()->route('crud')->with('message', 'Data berhasil diupdate!');

        $validation = $request->validate([
            'kode_barang' => 'required|max:10|min:3',
            'nama_barang' => 'required'
            ],
            [
            'kode_barang.required' => 'Harus Diisi',
            'kode_barang.min' => 'Minimal 3 Huruf',
            'kode_barang.max' => 'Maximal 10 Huruf',
            'nama_barang.required' => 'Harus Diisi'
            ]);
    }
}
