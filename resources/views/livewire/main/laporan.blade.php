<div>
    <div class="row justify-content-between mb-3">
        <div class="col-auto ms-3">
            <h3>Permintaan Informasi</h3>
        </div>
        <div class="col-auto">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control" placeholder="Cari Informasi" aria-label="Cari Informasi"
                    aria-describedby="basic-addon1" wire:model='searchlaporan' wire:input='resetPage'>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col table-responsive">
            <table class="table table-striped table-hover table-sm" style="font-size: 0.9rem;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Permintaan</th>
                        <th>Kategori</th>
                        <th>Isi Permintaan</th>
                        <th class="text-center">Informasi Tambahan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengaduans as $pengaduan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pengaduan->tanggal_pengaduan }}</td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        {{ $pengaduan->jenis_layanan }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        {{ $pengaduan->kategori }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        {{ $pengaduan->sub_kategori }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if (strlen($pengaduan->isi_pengaduan) > 20)
                                    <a href="javascript:void(0)"
                                        class="btn btn-outline-primary d-flex flex-column btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#UnivModal"
                                        wire:click='showIsiPengaduan({{ $pengaduan->id }})'>
                                        <div class="text-dark d-inline-block text-truncate" style="max-width: 150px;">
                                            {{ $pengaduan->isi_pengaduan }}</div>
                                    </a>
                                @else
                                    <a href="javascript:void(0)"
                                        class="btn btn-outline-primary d-flex flex-column btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#UnivModal"
                                        wire:click='showIsiPengaduan({{ $pengaduan->id }})'>
                                        <div class="text-dark d-inline-block">
                                            {{ $pengaduan->isi_pengaduan }}</div>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <div class="row text-center">
                                    <div class="col">
                                        @if ($pengaduan->tindaklanjuts->count() != 0)
                                            <a href="javascript:void(0)"
                                                class="link-offset-2 link-underline link-underline-opacity-0 text-success"
                                                data-bs-toggle="modal" data-bs-target="#UnivModal"
                                                wire:click='showTindakan({{ $pengaduan->id }})'>
                                                <i class="fa-regular fa-circle-check"></i><br>
                                                <small>Sudah Ada Jawaban</small>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)"
                                                class="link-offset-2 link-underline link-underline-opacity-0 text-danger">
                                                <i class="fa-regular fa-circle-xmark"></i><br>
                                                <small>Belum Ada Jawaban</small>
                                            </a>
                                        @endif
                                    </div>
                                    @if ($pengaduan->bukti_foto)
                                        <div class="col">
                                            <a href="javascript:void(0)" class="btn btn-outline-success border-0"
                                                data-bs-toggle="modal" data-bs-target="#UnivModal"
                                                wire:click='showGambar({{ $pengaduan->id }})'>
                                                <i class="fa-regular fa-image"></i><br>
                                                <small>Foto</small>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
                    @elseif($identitasindicator)
                        <div class="row">
                            <div class="col">
                                Nama: {{ $this->nama_pengadu }}
                            </div>
                        </div>
                    @elseif($gambarindicator)
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <img src="{{ asset($this->gambar) }}" alt="Foto Pengaduan" class="img-fluid" width="300">
                            </div>
                        </div>
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
                                        <div class="accordion-body text-center">
                                            @if ($tanggapan->bukti_foto)
                                                <div class="row justify-content-center">
                                                    <div class="col-auto w-25">
                                                        <img src="{{ asset($tanggapan->bukti_foto) }}"
                                                            alt="Foto Pengaduan" class="img-fluid">
                                                    </div>
                                                </div>
                                            @endif
                                            <p>
                                                {{ $tanggapan->tinjauan }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        Loading...
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>