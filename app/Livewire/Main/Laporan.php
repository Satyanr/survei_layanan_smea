<?php

namespace App\Livewire\Main;

use App\Models\LaporanTindakLanjut;
use Livewire\Component;
use App\Models\Pengaduan;
use Livewire\WithPagination;

class Laporan extends Component
{
    public $searchlaporan, $isipengaduan, $isipengaduan_laporan, $isitempat, $isijumlah, $gambar, $nama_pengadu, $no_telp_pengadu, $email_pengadu, $tindaklanjut;
    public $isipengaduanindicator = false,
        $gambarindicator = false,
        $identitasindicator = false,
        $tindaklanjutindicator = false;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $paginationName = 'Page';

    public function paginationView()
    {
        return 'components.admin.pagination_custom';
    }

    public function resetPage()
    {
        $this->gotoPage(1, 'Page');
    }
    public function render()
    {
        $searchlaporan = '%' . $this->searchlaporan . '%';
        return view('livewire.main.laporan', [
            'pengaduans' => Pengaduan::where('isi_pengaduan', 'LIKE', $searchlaporan)
                ->where('tentang', '=', 'Permintaan Informasi')
                ->orderBy('id', 'DESC')
                ->paginate(6, ['*'], 'Page'),
        ]);
    }

    public function showIsiPengaduan($id)
    {
        $pengaduan = Pengaduan::find($id);
        $this->isipengaduan_laporan = $pengaduan->isi_pengaduan;
        $this->isitempat = $pengaduan->tempat;
        $this->isijumlah = $pengaduan->jumlah;


        $this->isipengaduanindicator = true;
        $this->gambarindicator = false;
        $this->identitasindicator = false;
        $this->tindaklanjutindicator = false;
    }

    public function showTindakan($id)
    {
        $this->tindaklanjut = LaporanTindakLanjut::where('pengaduan_id', $id)->get();

        $this->tindaklanjutindicator = true;
        $this->isipengaduanindicator = false;
        $this->gambarindicator = false;
        $this->identitasindicator = false;
    }

    public function showGambar($id)
    {
        $pengaduan = Pengaduan::find($id);
        $this->gambar = $pengaduan->bukti_foto;

        $this->isipengaduanindicator = false;
        $this->gambarindicator = true;
        $this->identitasindicator = false;
        $this->tindaklanjutindicator = false;
    }

    public function showIdentitas($id)
    {
        $pengaduan = Pengaduan::find($id);
        $this->nama_pengadu = $pengaduan->nama_pengadu;
        $this->no_telp_pengadu = $pengaduan->no_telp_pengadu;
        $this->email_pengadu = $pengaduan->email_pengadu;

        $this->isipengaduanindicator = false;
        $this->gambarindicator = false;
        $this->identitasindicator = true;
        $this->tindaklanjutindicator = false;
    }
}