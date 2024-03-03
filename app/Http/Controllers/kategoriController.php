<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class kategoriController extends Controller
{
    public function index(){
        $kategori = Kategori::all();
        return view('backend.content.kategori.list', compact('kategori'));
    }

    public function tambah(){
        return view('backend.content.kategori.formTambah');
    }

    public function prosesTambah(Request $request){
        $this->validate($request, [
            'nama_kategori' => 'required'
        ]);

        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;

        try {
            $kategori->save();
            return redirect(route('kategori.index'))->with('pesan',['success','berhasil tambah kategori']);
        }catch (\Exception $e){
            return redirect(route('kategori.index'))->with('pesan',['danger','gagal tambah kategori']);
        }
    }

    public function ubah($id){
        $kategori = Kategori::findOrFail($id);
        return view('backend.content.kategori.formUbah', compact('kategori'));
    }

    public function prosesUbah(Request $request){
        $this->validate($request, [
            'id_kategori' => 'required',
            'nama_kategori' => 'required'
        ]);

        $kategori = Kategori::findOrFail($request->id_kategori);
        $kategori->nama_kategori = $request->nama_kategori;

        try {
            $kategori->save();
            return redirect(route('kategori.index'))->with('pesan',['success','berhasil ubah kategori']);
        }catch (\Exception $e){
            return redirect(route('kategori.index'))->with('pesan',['danger','gagal ubah kategori']);
        }
    }

    public function hapus($id){
        $kategori = Kategori::findOrFail($id);

        try {
            $kategori->delete();
            return redirect(route('kategori.index'))->with('pesan',['success','berhasil hapus kategori']);
        }catch (\Exception $e){
            return redirect(route('kategori.index'))->with('pesan',['danger','gagal hapus kategori']);
        }
    }
}
