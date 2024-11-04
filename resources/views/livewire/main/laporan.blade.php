<div>
    <div class="row justify-content-center mb-3">
        <div class="col-auto ms-3">
            <h3>Permintaan Informasi</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-auto">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control" placeholder="Cari Informasi" aria-label="Cari Informasi"
                    aria-describedby="basic-addon1" wire:model='searchlaporan' wire:input='resetPage'>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @forelse ($pengaduans as $pengaduan)
            <div class="col">
                <div class="card h-100 mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $pengaduan->kategori }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $pengaduan->tanggal_pengaduan }}
                                </h6>
                                @if (strlen($pengaduan->isi_pengaduan) > 100)
                                    <a href="javascript:void(0)"
                                        class="btn btn-outline-primary d-flex flex-column btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#UnivModal"
                                        wire:click="showIsiPengaduan('{{ Crypt::encrypt($pengaduan->id) }}')">
                                        <div class="text-dark d-inline-block text-truncate text-start"
                                            style="max-width: 150px;">
                                            {{ $pengaduan->isi_pengaduan }}</div>
                                    </a>
                                @else
                                    <a href="javascript:void(0)"
                                        class="btn btn-outline-primary d-flex flex-column btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#UnivModal"
                                        wire:click="showIsiPengaduan('{{ Crypt::encrypt($pengaduan->id) }}')">
                                        <div class="text-dark d-inline-block text-start">
                                            {{ $pengaduan->isi_pengaduan }}</div>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="col text-center m-auto">
                            @if ($pengaduan->tindaklanjuts->count() != 0)
                                <a href="javascript:void(0)" class="text-success m-auto" style="text-decoration: none;"
                                    data-bs-toggle="modal" data-bs-target="#UnivModal"
                                    wire:click="showTindakan('{{ Crypt::encrypt($pengaduan->id) }}')">
                                    <i class="fa-regular fa-circle-check"></i><br>
                                    <small>Sudah Ada Jawaban</small>
                                </a>
                            @else
                                <a href="javascript:void(0)" class="text-danger" style="text-decoration: none;">
                                    <i class="fa-regular fa-circle-xmark"></i><br>
                                    <small>Belum Ada Jawaban</small>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <h3 class="text-center">Belum Ada Permintaan Informasi</h3>
            </div>
        @endforelse
    </div>
    <div class="row justify-content-center">
        <div class="col-auto">
            {{ $pengaduans->links() }}
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="UnivModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    @if ($isipengaduanindicator)
                        <h5 class="modal-title" id="exampleModalLabel">Isi Permintaan Informasi</h5>
                        @if ($this->isitempat)
                            <h6>Tempat :</h6>
                            <p class="text-break">
                                {{ $this->isitempat }}
                            </p>

                            <h6>Deskripsi :</h6>
                        @endif
                        <p class="text-break">
                            {{ $this->isipengaduan_laporan }}
                        </p>
                        @if ($this->gambar)
                            <h6>Keterangan Tambahan:</h6>

                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <img src="{{ asset($this->gambar) }}" alt="Foto Pengaduan" class="img-fluid"
                                        width="300">
                                </div>
                            </div>
                        @endif
                    @elseif($identitasindicator)
                        <div class="row">
                            <div class="col">
                                Nama: {{ $this->nama_pengadu }}
                            </div>
                        </div>
                        {{-- @elseif($gambarindicator)
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <img src="{{ asset($this->gambar) }}" alt="Foto Pengaduan" class="img-fluid"
                                    width="300">
                            </div>
                        </div> --}}
                    @elseif($tindaklanjutindicator)
                        <div class="accordion" id="accordionExample">
                            @foreach ($tindaklanjut as $tanggapan)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $tanggapan->id }}" aria-expanded="true"
                                            aria-controls="collapse{{ $tanggapan->id }}">
                                            Unit: {{ $tanggapan->user->name }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $tanggapan->id }}" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body ps-2">
                                            <h6>Jawaban:</h6>
                                            <p>
                                                {{ $tanggapan->tindakan_korektif }}
                                            </p>

                                            @if ($tanggapan->bukti_foto)
                                                <h6>Keterangan Tambahan</h6>
                                                <div class="row justify-content-center">
                                                    <div class="col-auto w-25">
                                                        <img src="{{ asset($tanggapan->bukti_foto) }}"
                                                            alt="Foto Pengaduan" class="img-fluid">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        Memuat Data...
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
