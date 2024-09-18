<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Pengaduan;
use App\Models\LaporanTindakLanjut;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class TindakLanjut extends Component
{
    use WithFileUploads;
    public $pengaduan_id, $penyebab, $tinkor, $tinjauan, $kesimpulan, $bukti_foto, $koreksi;
    public function render()
    {
        if (auth()->user()) {
            $tinjut = LaporanTindakLanjut::where('pengaduan_id', $this->pengaduan_id)
                ->where('user_id', auth()->user()->id)
                ->first();
            if ($tinjut) {
                $this->penyebab = $tinjut->penyebab;
                $this->tinkor = $tinjut->tindakan_korektif;
                $this->tinjauan = $tinjut->tinjauan;
                $this->kesimpulan = $tinjut->kesimpulan;
                $this->koreksi = $tinjut->koreksi;
            }
        }
        return view('livewire.admin.tindak-lanjut', ['pengaduan' => Pengaduan::find($this->pengaduan_id)]);
    }

    public function store()
    {
        $this->validate(
            [
                'tinkor' => 'required',
                'tinjauan' => 'required',
                'kesimpulan' => 'required',
            ],
            [
                'tinkor.required' => 'Tindakan korektif tidak boleh kosong',
                'tinjauan.required' => 'Tinjauan tidak boleh kosong',
                'kesimpulan.required' => 'Kesimpulan tidak boleh kosong',
            ],
        );

        if (
            LaporanTindakLanjut::where('pengaduan_id', $this->pengaduan_id)
                ->where('user_id', auth()->user()->id)
                ->first()
        ) {
            if (Pengaduan::find($this->pengaduan_id)->tentang == 'Kerusakan') {
                $this->validate(
                    [
                        'bukti_foto' => 'required|image',
                        'penyebab' => 'required',
                    ],

                    [
                        'bukti_foto.image' => 'File harus berupa gambar',
                        'bukti_foto.required' => 'buktiforo tidak boleh kosong',
                        'penyebab.required' => 'Penyebab tidak boleh kosong',
                    ],
                );

                $filename = time() . $this->bukti_foto->getClientOriginalName();
                $destinationPath = 'public/tindakan_img';

                Storage::putFileAs($destinationPath, $this->bukti_foto, $filename);
                LaporanTindakLanjut::where('pengaduan_id', $this->pengaduan_id)
                    ->where('user_id', auth()->user()->id)
                    ->update([
                        'penyebab' => $this->penyebab,
                        'tindakan_korektif' => $this->tinkor,
                        'tinjauan' => $this->tinjauan,
                        'koreksi' => $this->koreksi,
                        'kesimpulan' => $this->kesimpulan,
                        'bukti_foto' => 'storage/tindakan_img/' . $filename,
                    ]);
            } else {
                if ($this->bukti_foto) {
                    $this->validate(
                        ['bukti_foto' => 'image'],

                        ['bukti_foto.image' => 'File harus berupa gambar', 'bukti_foto.max' => 'File tidak boleh lebih dari 1MB'],
                    );

                    $filename = time() . $this->bukti_foto->getClientOriginalName();
                    $destinationPath = 'public/tindakan_img';

                    Storage::putFileAs($destinationPath, $this->bukti_foto, $filename);
                    LaporanTindakLanjut::where('pengaduan_id', $this->pengaduan_id)
                        ->where('user_id', auth()->user()->id)
                        ->update([
                            'penyebab' => $this->penyebab,
                            'tindakan_korektif' => $this->tinkor,
                            'tinjauan' => $this->tinjauan,
                            'koreksi' => $this->koreksi,
                            'kesimpulan' => $this->kesimpulan,
                            'bukti_foto' => 'storage/tindakan_img/' . $filename,
                        ]);
                } else {
                    LaporanTindakLanjut::where('pengaduan_id', $this->pengaduan_id)
                        ->where('user_id', auth()->user()->id)
                        ->update([
                            'penyebab' => $this->penyebab,
                            'tindakan_korektif' => $this->tinkor,
                            'tinjauan' => $this->tinjauan,
                            'koreksi' => $this->koreksi,
                            'kesimpulan' => $this->kesimpulan,
                        ]);
                }
            }
        } else {
            if (Pengaduan::find($this->pengaduan_id)->tentang == 'Kerusakan') {
                $this->validate(
                    [
                        'bukti_foto' => 'required|image',
                        'penyebab' => 'required',
                    ],

                    [
                        'bukti_foto.image' => 'File harus berupa gambar',
                        'bukti_foto.required' => 'buktiforo tidak boleh kosong',
                        'penyebab.required' => 'Penyebab tidak boleh kosong',
                    ],
                );

                $filename = time() . $this->bukti_foto->getClientOriginalName();
                $destinationPath = 'public/tindakan_img';

                Storage::putFileAs($destinationPath, $this->bukti_foto, $filename);
                    LaporanTindakLanjut::create([
                        'pengaduan_id' => $this->pengaduan_id,
                        'user_id' => auth()->user()->id,
                        'penyebab' => $this->penyebab,
                        'tindakan_korektif' => $this->tinkor,
                        'tinjauan' => $this->tinjauan,
                        'koreksi' => $this->koreksi,
                        'kesimpulan' => $this->kesimpulan,
                        'bukti_foto' => 'storage/tindakan_img/' . $filename,
                    ]);
            } else {
                if ($this->bukti_foto) {
                    $this->validate(
                        ['bukti_foto' => 'image'],

                        ['bukti_foto.image' => 'File harus berupa gambar', 'bukti_foto.max' => 'File tidak boleh lebih dari 1MB'],
                    );

                    $filename = time() . $this->bukti_foto->getClientOriginalName();
                    $destinationPath = 'public/tindakan_img';

                    Storage::putFileAs($destinationPath, $this->bukti_foto, $filename);
                    LaporanTindakLanjut::create([
                        'pengaduan_id' => $this->pengaduan_id,
                        'user_id' => auth()->user()->id,
                        'penyebab' => $this->penyebab,
                        'tindakan_korektif' => $this->tinkor,
                        'tinjauan' => $this->tinjauan,
                        'koreksi' => $this->koreksi,
                        'kesimpulan' => $this->kesimpulan,
                        'bukti_foto' => 'storage/tindakan_img/' . $filename,
                    ]);
                } else {
                    LaporanTindakLanjut::create([
                        'pengaduan_id' => $this->pengaduan_id,
                        'user_id' => auth()->user()->id,
                        'penyebab' => $this->penyebab,
                        'tindakan_korektif' => $this->tinkor,
                        'tinjauan' => $this->tinjauan,
                        'koreksi' => $this->koreksi,
                        'kesimpulan' => $this->kesimpulan,
                    ]);
                }
            }
        }
        return redirect()
            ->route('admin.daftarpengaduan', Pengaduan::find($this->pengaduan_id)->tentang)
            ->with('message', 'Pengaduan berhasil ditindak lanjuti');
    }
}
