<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Models\Pengaduan;
use Livewire\WithPagination;
use App\Models\PengaduanLink;
use App\Models\LaporanTindakLanjut;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class DaftarPengaduan extends Component
{
    public $searchlaporan, $isipengaduan, $gambar, $nama_pengadu, $isitempat, $isijumlah, $no_telp_pengadu, $email_pengadu, $tindaklanjut, $idpengaduan, $selectedUnits, $tentangcrud;
    public $isipengaduanindicator = false,
        // $gambarindicator = false,
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
    public function mount()
    {
        $this->selectedUnits = [];
    }

    public function render()
    {
        $searchlaporan = '%' . $this->searchlaporan . '%';
        if (auth()->user()->role == 'UnitKerja') {
            $pengaduans = Pengaduan::where('isi_pengaduan', 'LIKE', $searchlaporan)
                ->where('tentang', $this->tentangcrud)
                ->whereHas('pengaduanLinks', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
                ->orderBy('id', 'DESC')
                ->paginate(6, ['*'], 'Page');
        } else {
            $pengaduans = Pengaduan::where('isi_pengaduan', 'LIKE', $searchlaporan)
                ->where('tentang', $this->tentangcrud)
                ->orderBy('id', 'DESC')
                ->paginate(6, ['*'], 'Page');
        }
        return view('livewire.admin.daftar-pengaduan', [
            'pengaduans' => $pengaduans,
            'unitskerja' => User::where('role', 0)->get(),
        ]);
    }

    public function setidpengaduan($id)
    {
        $id = Crypt::decrypt($id);
        $this->idpengaduan = $id;
    }

    public function resetInput()
    {
        $this->isipengaduan = '';
        $this->gambar = '';
        $this->nama_pengadu = '';
        $this->no_telp_pengadu = '';
        $this->email_pengadu = '';
        $this->tindaklanjut = '';
        $this->selectedUnits = [];
    }

    public function teruskan()
    {
        $pengaduan = Pengaduan::find($this->idpengaduan);

        foreach ($this->selectedUnits as $unitId => $value) {
            if ($value) {
                $pengaduanLink = PengaduanLink::where('pengaduan_id', $pengaduan->id)
                    ->where('user_id', $unitId)
                    ->first();
                if ($pengaduanLink) {
                    continue;
                }
                PengaduanLink::create([
                    'pengaduan_id' => $pengaduan->id,
                    'user_id' => $unitId,
                ]);
            }
        }

        $this->resetInput();
        session()->flash('message', 'Pengaduan Berhasil Diteruskan');
    }

    public function showIsiPengaduan($id)
    {
        $id = Crypt::decrypt($id);
        $pengaduan = Pengaduan::find($id);
        $this->isipengaduan = $pengaduan->isi_pengaduan;
        $this->isitempat = $pengaduan->tempat;
        $this->isijumlah = $pengaduan->jumlah;
        $this->gambar = '';

        if ($pengaduan->bukti_foto) {
            $this->gambar = $pengaduan->bukti_foto;
        }

        $this->isipengaduanindicator = true;
        // $this->gambarindicator = false;
        $this->identitasindicator = false;
        $this->tindaklanjutindicator = false;
    }

    public function showTindakan($id)
    {
        $id = Crypt::decrypt($id);
        $this->tindaklanjut = LaporanTindakLanjut::where('pengaduan_id', $id)->get();

        $this->tindaklanjutindicator = true;
        $this->isipengaduanindicator = false;
        // $this->gambarindicator = false;
        $this->identitasindicator = false;
    }

    public function destroyTindakan($id)
    {
        $id = Crypt::decrypt($id);
        $tindakan = LaporanTindakLanjut::find($id);
        if ($tindakan->bukti_foto) {
            $path = str_replace('storage/', 'public/', $tindakan->bukti_foto);
            Storage::delete($path);
        }
        $tindakan->delete();
        session()->flash('message', 'Tindakan Berhasil Dihapus');
        return redirect()->to('/admin/daftar-pengaduan/' . $this->tentangcrud);
    }

    // public function showGambar($id)
    // {
    //     $id = Crypt::decrypt($id);
    //     $pengaduan = Pengaduan::find($id);
    //     $this->gambar = $pengaduan->bukti_foto;

    //     $this->isipengaduanindicator = false;
    //     $this->gambarindicator = true;
    //     $this->identitasindicator = false;
    //     $this->tindaklanjutindicator = false;
    // }

    public function showIdentitas($id)
    {
        $id = Crypt::decrypt($id);
        $pengaduan = Pengaduan::find($id);
        $this->nama_pengadu = $pengaduan->nama_pengadu;
        $this->no_telp_pengadu = $pengaduan->no_telp_pengadu;
        $this->email_pengadu = $pengaduan->email_pengadu;

        $this->isipengaduanindicator = false;
        // $this->gambarindicator = false;
        $this->identitasindicator = true;
        $this->tindaklanjutindicator = false;
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $itemlaporan = Pengaduan::find($id);


        if ($itemlaporan->bukti_foto) {
            $path = str_replace('storage/', 'public/', $itemlaporan->bukti_foto);
            Storage::delete($path);
        }

        foreach ($itemlaporan->tindaklanjuts as $tindaklanjut) {
            if ($tindaklanjut->bukti_foto) {
                $path = str_replace('storage/', 'public/', $tindaklanjut->bukti_foto);
                Storage::delete($path);
            }
        }
        
        $itemlaporan->tindaklanjuts()->delete();
        $itemlaporan->pengaduanLinks()->delete();
        $itemlaporan->delete();
        session()->flash('message', 'Berhasil Dihapus');
        return redirect()->to('/admin/daftar-pengaduan/' . $this->tentangcrud);
    }
}
