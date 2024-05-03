<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Models\Pengaduan;
use App\Models\PengaduanLink;
use App\Models\LaporanTindakLanjut;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.index', [
            'pengguna' => User::all(),
            'pengaduan' => Pengaduan::all(),
            'pengaduanCount' => Pengaduan::notHaveTindakLanjut(),
            'notLinked' => Pengaduan::notHaveLinked(),
            'ditindak' => Pengaduan::whereHas('tindaklanjuts')->count(),
            'unitkerja' => PengaduanLink::where('user_id', auth()->user()->id)->count(),
            'tindaklanjut' => LaporanTindakLanjut::where('user_id', auth()->user()->id)->count(),
            
        ]);
    }
}