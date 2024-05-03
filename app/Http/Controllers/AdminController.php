<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin.index');
    }
    public function pengguna()
    {
        return view('admin.pengguna');
    }
    public function daftarpengaduan($tentang)
    {
        return view('admin.daftar-pengaduan', compact('tentang'));
    }
    public function tindaklanjut($id)
    {
        return view('admin.tindak-lanjuti', ['id' => $id]);
    }
    public function kategori()
    {
        return view('admin.kategori');
    }

    public function menulaporan()
    {
        $pengaduans = \App\Models\Pengaduan::all();
        return view('admin.laporan-menu', compact('pengaduans'));
    }
}