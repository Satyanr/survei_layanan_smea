<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\SubKategori;
use Livewire\WithPagination;
use App\Models\SubKategoriLink;
use Illuminate\Support\Facades\Crypt;
use App\Models\Kategori as KategoriModel;

class Kategori extends Component
{
    public $searchkategori, $nama_kategori, $nama_layanan, $kategori_id, $kode_kategori;
    public $updateMode = false;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $paginationName = 'KategoriPage';

    public function paginationView()
    {
        return 'components.admin.pagination_custom';
    }
    public function resetKategoriPage()
    {
        $this->gotoPage(1, 'KategoriPage');
    }
    public function resetInput()
    {
        $this->nama_kategori = '';
        $this->nama_layanan = '';
        $this->kategori_id = '';
        $this->kode_kategori = '';
    }
    public function render()
    {
        $currentKategoriPage = request()->input('KategoriPage', 1);
        return view('livewire.admin.kategori', [
            'kategoris' => KategoriModel::where('nama', 'LIKE', '%' . $this->searchkategori . '%')
                ->orderBy('id', 'DESC')
                ->paginate(6, ['*'], 'KategoriPage'),
            'kategorisInput' => KategoriModel::all(),
            'currentKategoriPage' => $currentKategoriPage,
        ]);
    }

    public function storeKategori()
    {
        $this->validate(
            [
                'nama_kategori' => 'required',
                'kode_kategori' => 'required',
            ],
            [
                'nama_kategori.required' => 'Nama kategori tidak boleh kosong',
                'kode_kategori.required' => 'Kode kategori tidak boleh kosong',
            ],
        );
        KategoriModel::create([
            'nama' => $this->nama_kategori,
            'kode_kategori' => $this->kode_kategori,
        ]);
        session()->flash('message', 'Kategori berhasil ditambahkan');
        $this->resetInput();
    }
   
    public function destroyKategori($id)
    {
        $id = Crypt::decrypt($id); 
        KategoriModel::find($id)->delete();
        session()->flash('message', 'Kategori berhasil dihapus');
    }
}