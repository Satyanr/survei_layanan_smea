<?php

namespace App\Livewire\Admin;

use App\Models\SubKategoriLink;
use Livewire\Component;
use App\Models\Kategori as KategoriModel;
use App\Models\SubKategori;
use Livewire\WithPagination;

class Kategori extends Component
{
    public $searchkategori, $searchsubkategori, $nama_kategori, $nama_subkategori, $nama_layanan, $kategori_id, $kode_kategori, $kode_subkategori;
    public $updateMode = false;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $paginationName;
    public function changePagination($paginationName)
    {
        $this->paginationName = $paginationName;
    }
    public function paginationView()
    {
        return 'components.admin.pagination_custom';
    }
    public function resetKategoriPage()
    {
        $this->gotoPage(1, 'KategoriPage');
    }
    public function resetSubKategoriPage()
    {
        $this->gotoPage(1, 'SubKategoriPage');
    }

    public function resetInput()
    {
        $this->nama_kategori = '';
        $this->nama_subkategori = '';
        $this->nama_layanan = '';
        $this->kategori_id = '';
        $this->kode_kategori = '';
        $this->kode_subkategori = '';
    }
    public function render()
    {
        $currentKategoriPage = request()->input('KategoriPage', 1);
        $currentSubKategoriPage = request()->input('SubKategoriPage', 1);
        return view('livewire.admin.kategori', [
            'kategoris' => KategoriModel::where('nama', 'LIKE', '%' . $this->searchkategori . '%')
                ->orderBy('id', 'DESC')
                ->paginate(6, ['*'], 'KategoriPage'),
            'subkategoris' => SubKategori::where('nama', 'LIKE', '%' . $this->searchsubkategori . '%')
                ->orderBy('id', 'DESC')
                ->paginate(6, ['*'], 'SubKategoriPage'),
            'kategorisInput' => KategoriModel::all(),
            'currentKategoriPage' => $currentKategoriPage,
            'currentSubKategoriPage' => $currentSubKategoriPage,
        ]);
    }

    public function storeKategori()
    {
        $this->validate(
            [
                'nama_kategori' => 'required',
                // 'nama_layanan' => 'required',
            ],
            [
                'nama_kategori.required' => 'Nama kategori tidak boleh kosong',
                // 'nama_layanan.required' => 'Pilih Jenis Layanan',
            ],
        );
        KategoriModel::create([
            // 'nama_layanan' => $this->nama_layanan,
            'nama' => $this->nama_kategori,
            'kode_kategori' => $this->kode_kategori,
        ]);
        session()->flash('message', 'Kategori berhasil ditambahkan');
        $this->resetInput();
    }
    public function storeSubKategori()
    {
        $this->validate([
            'nama_subkategori' => 'required',
            'kategori_id' => 'required',
        ]);

        SubKategori::create([
            'nama' => $this->nama_subkategori,
            'kategori_id' => $this->kategori_id,
            // 'kode_kategori' => $this->kode_subkategori,
        ]);

        session()->flash('message', 'Subkategori berhasil ditambahkan');
        $this->resetInput();
    }

    public function destroyKategori($id)
    {
        KategoriModel::find($id)->delete();
        session()->flash('message', 'Kategori berhasil dihapus');
    }
    public function destroySubKategori($id)
    {
        SubKategori::find($id)->delete();
        session()->flash('message', 'Subkategori berhasil dihapus');
    }
}