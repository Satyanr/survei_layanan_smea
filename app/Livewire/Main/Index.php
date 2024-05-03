<?php

namespace App\Livewire\Main;

use Livewire\Component;
use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Models\SubKategori;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;
    public $tanggal_pengaduan, $identitas_pengaduan, $nama_pengadu, $no_telp_pengadu, $email_pengadu, $isi_pengaduan, $jenis_layanan, $bukti_foto, $kategori, $subkategori, $tempat, $tentang, $type, $kode_kategori;
    public $identitason = false;
    public $subkaton = false,
        $tentangon = false,
        $katforsub;

    public function render()
    {
        return view('livewire.main.index', [
            'kategoris' => Kategori::where('kode_kategori', 'LIKE',$this->kode_kategori)
                ->orWhere('kode_kategori', 'LIKE','TNG5')
                ->get(),
            // 'subkategoris' => SubKategori::all(),
        ]);
    }
    public function idon()
    {
        $this->identitason = true;
    }
    public function idoff()
    {
        $this->identitason = false;
    }

    public function tenton()
    {
        $this->tentangon = true;
        $this->kode_kategori = 'TNG4';

        $this->subkategori = null;
        $this->kategori = null;
    }
    public function tentoff()
    {
        $this->tentangon = false;
        if ($this->tentang == 'Pengaduan') {
            $this->kode_kategori = 'TNG1';
        } elseif ($this->tentang == 'Permintaan Informasi') {
            $this->kode_kategori = 'TNG2';
        } else {
            $this->kode_kategori = 'TNG3';
        }

        $this->subkategori = null;
        $this->kategori = null;
    }
    public function resetInput()
    {
        $this->tanggal_pengaduan = null;
        $this->identitas_pengaduan = null;
        $this->nama_pengadu = null;
        $this->no_telp_pengadu = null;
        $this->email_pengadu = null;
        $this->isi_pengaduan = null;
        $this->jenis_layanan = null;
        $this->bukti_foto = null;
        $this->kategori = null;
        $this->subkategori = null;
        $this->tempat = null;
        $this->tentang = null;
        $this->type = null;
        $this->kode_kategori = null;
    }

    // public function isi_kat()
    // {
    //     $this->subkaton = true;
    // }

    // public function akadon()
    // {
    //     $this->katforsub = $this->kategori;
    // }

    public function store()
    {
        $this->validate(
            [
                'identitas_pengaduan' => 'required',
                'isi_pengaduan' => 'required',
                // 'jenis_layanan' => 'required',
                // 'subkategori' => 'required',
                'kategori' => 'required',
                'tentang' => 'required',
                // 'type' => 'required',
            ],
            [
                'identitas_pengaduan.required' => 'Identitas tidak boleh kosong',
                'isi_pengaduan.required' => 'Isi Pengaduan tidak boleh kosong',
                // 'jenis_layanan.required' => 'Jenis Layanan tidak boleh kosong',
                // 'subkategori.required' => 'Sub Kategori tidak boleh kosong',
                'kategori.required' => 'Kategori tidak boleh kosong',
                'tentang.required' => 'tentang tidak boleh kosong',
                // 'type.required' => 'Tipe tidak boleh kosong',
            ],
        );

        if ($this->identitason) {
            $this->validate(
                [
                    'nama_pengadu' => 'required',
                    'no_telp_pengadu' => 'required',
                    'email_pengadu' => 'required',
                ],
                [
                    'nama_pengadu.required' => 'Nama Pengadu tidak boleh kosong',
                    'no_telp_pengadu.required' => 'No Telp Pengadu tidak boleh kosong',
                    'email_pengadu.required' => 'Email Pengadu tidak boleh kosong',
                ],
            );
            if ($this->tentangon) {
                $this->validate(
                    [
                        'tempat' => 'required',
                        'bukti_foto' => 'required',
                    ],
                    [
                        'tempat.required' => 'Tempat tidak boleh kosong',
                        'bukti_foto.required' => 'Bukti Foto tidak boleh kosong',
                    ],
                );

                if ($this->bukti_foto) {
                    $filename = time() . $this->bukti_foto->getClientOriginalName();
                    $destinationPath = 'public/pengaduan_img';

                    Storage::putFileAs($destinationPath, $this->bukti_foto, $filename);

                    $data = [
                        'tanggal_pengaduan' => date('Y-m-d'),
                        'identitas_pengaduan' => $this->identitas_pengaduan,
                        'nama_pengadu' => $this->nama_pengadu,
                        'no_telp_pengadu' => $this->no_telp_pengadu,
                        'email_pengadu' => $this->email_pengadu,
                        'isi_pengaduan' => $this->isi_pengaduan,
                        // 'jenis_layanan' => $this->jenis_layanan,
                        'kategori' => $this->kategori,
                        'type' => $this->type,
                        // 'sub_kategori' => $this->subkategori,
                        'kode_kategori' => $this->kode_kategori,
                        'tempat' => $this->tempat,
                        'tentang' => $this->tentang,
                        'bukti_foto' => 'storage/pengaduan_img/' . $filename,
                    ];

                    Pengaduan::create($data);
                } else {
                    $data = [
                        'tanggal_pengaduan' => date('Y-m-d'),
                        'identitas_pengaduan' => $this->identitas_pengaduan,
                        'nama_pengadu' => $this->nama_pengadu,
                        'no_telp_pengadu' => $this->no_telp_pengadu,
                        'email_pengadu' => $this->email_pengadu,
                        'isi_pengaduan' => $this->isi_pengaduan,
                        // 'jenis_layanan' => $this->jenis_layanan,
                        'kategori' => $this->kategori,
                        'type' => $this->type,
                        // 'sub_kategori' => $this->subkategori,
                        'kode_kategori' => $this->kode_kategori,
                        'tempat' => $this->tempat,
                        'tentang' => $this->tentang,
                    ];

                    Pengaduan::create($data);
                }
            } else {
                if ($this->bukti_foto) {
                    $filename = time() . $this->bukti_foto->getClientOriginalName();
                    $destinationPath = 'public/pengaduan_img';

                    Storage::putFileAs($destinationPath, $this->bukti_foto, $filename);

                    $data = [
                        'tanggal_pengaduan' => date('Y-m-d'),
                        'identitas_pengaduan' => $this->identitas_pengaduan,
                        'nama_pengadu' => $this->nama_pengadu,
                        'no_telp_pengadu' => $this->no_telp_pengadu,
                        'email_pengadu' => $this->email_pengadu,
                        'isi_pengaduan' => $this->isi_pengaduan,
                        // 'jenis_layanan' => $this->jenis_layanan,
                        'kategori' => $this->kategori,
                        'type' => $this->type,
                        // 'sub_kategori' => $this->subkategori,
                        'kode_kategori' => $this->kode_kategori,
                        'tentang' => $this->tentang,
                        'bukti_foto' => 'storage/pengaduan_img/' . $filename,
                    ];

                    Pengaduan::create($data);
                } else {
                    $data = [
                        'tanggal_pengaduan' => date('Y-m-d'),
                        'identitas_pengaduan' => $this->identitas_pengaduan,
                        'nama_pengadu' => $this->nama_pengadu,
                        'no_telp_pengadu' => $this->no_telp_pengadu,
                        'email_pengadu' => $this->email_pengadu,
                        'isi_pengaduan' => $this->isi_pengaduan,
                        // 'jenis_layanan' => $this->jenis_layanan,
                        'kategori' => $this->kategori,
                        'type' => $this->type,
                        // 'sub_kategori' => $this->subkategori,
                        'kode_kategori' => $this->kode_kategori,
                        'tentang' => $this->tentang,
                    ];

                    Pengaduan::create($data);
                }
            }
            $this->identitason = false;
        } else {
            if ($this->tentangon) {
                $this->validate(
                    [
                        'tempat' => 'required',
                        'bukti_foto' => 'required',
                    ],
                    [
                        'tempat.required' => 'Tempat tidak boleh kosong',
                        'bukti_foto.required' => 'Bukti Foto tidak boleh kosong',
                    ],
                );

                if ($this->bukti_foto) {
                    $filename = time() . $this->bukti_foto->getClientOriginalName();
                    $destinationPath = 'public/pengaduan_img';

                    Storage::putFileAs($destinationPath, $this->bukti_foto, $filename);
                    $data = [
                        'tanggal_pengaduan' => date('Y-m-d'),
                        'identitas_pengaduan' => $this->identitas_pengaduan,
                        'isi_pengaduan' => $this->isi_pengaduan,
                        // 'jenis_layanan' => $this->jenis_layanan,
                        'kategori' => $this->kategori,
                        'type' => $this->type,
                        // 'sub_kategori' => $this->subkategori,
                        'kode_kategori' => $this->kode_kategori,
                        'tempat' => $this->tempat,
                        'tentang' => $this->tentang,
                        'bukti_foto' => 'storage/pengaduan_img/' . $filename,
                    ];

                    Pengaduan::create($data);
                } else {
                    $data = [
                        'tanggal_pengaduan' => date('Y-m-d'),
                        'identitas_pengaduan' => $this->identitas_pengaduan,
                        'isi_pengaduan' => $this->isi_pengaduan,
                        // 'jenis_layanan' => $this->jenis_layanan,
                        'kategori' => $this->kategori,
                        'type' => $this->type,
                        // 'sub_kategori' => $this->subkategori,
                        'kode_kategori' => $this->kode_kategori,
                        'tempat' => $this->tempat,
                        'tentang' => $this->tentang,
                    ];

                    Pengaduan::create($data);
                }
            } else {
                if ($this->bukti_foto) {
                    $filename = time() . $this->bukti_foto->getClientOriginalName();
                    $destinationPath = 'public/pengaduan_img';

                    Storage::putFileAs($destinationPath, $this->bukti_foto, $filename);
                    $data = [
                        'tanggal_pengaduan' => date('Y-m-d'),
                        'identitas_pengaduan' => $this->identitas_pengaduan,
                        'isi_pengaduan' => $this->isi_pengaduan,
                        // 'jenis_layanan' => $this->jenis_layanan,
                        'kategori' => $this->kategori,
                        'type' => $this->type,
                        // 'sub_kategori' => $this->subkategori,
                        'kode_kategori' => $this->kode_kategori,
                        'tentang' => $this->tentang,
                        'bukti_foto' => 'storage/pengaduan_img/' . $filename,
                    ];

                    Pengaduan::create($data);
                } else {
                    $data = [
                        'tanggal_pengaduan' => date('Y-m-d'),
                        'identitas_pengaduan' => $this->identitas_pengaduan,
                        'isi_pengaduan' => $this->isi_pengaduan,
                        // 'jenis_layanan' => $this->jenis_layanan,
                        'kategori' => $this->kategori,
                        'type' => $this->type,
                        // 'sub_kategori' => $this->subkategori,
                        'kode_kategori' => $this->kode_kategori,
                        'tentang' => $this->tentang,
                    ];

                    Pengaduan::create($data);
                }
            }
        }

        $this->identitason = false;
        $this->tentangon = false;
        $this->subkaton = false;
        $this->resetInput();
        session()->flash('message', 'Pengaduan berhasil dikirim');
    }
}
