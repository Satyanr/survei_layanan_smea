<div>
    <div class="row justify-content-between mb-5">
        <div class="col-auto ms-3">
            <h3>Laporan</h3>
        </div>
        <div class="col-auto">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control" placeholder="Cari Laporan" aria-label="Cari Laporan"
                    aria-describedby="basic-addon1" wire:model='searchlaporan' wire:input='resetPage'>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col">
            <form action="{{ route('laporan-monev') }}" method="GET">
                <div class="col">
                    <input type="text" class="form-control" name="tentang" value="{{ $this->tentangcrud }}" hidden readonly>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" name="start" id="start" required>
                        <span class="input-group-text">to</span>
                        <input type="date" class="form-control" name="end" id="end" required>

                        <button class="btn btn-primary" type="submit">Unduh</button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}
    <div class="row mb-3">
        <div class="col">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col table-responsive">
            <table class="table table-striped table-hover table-sm" style="font-size: 0.9rem;">
                <thead>
                    <tr>
                        <th>Tanggal Pengaduan</th>
                        <th>Identitas Pengadu</th>
                        <th>Kategori Pengaduan</th>
                        <th>Isi Pengaduan</th>
                        <th>Informasi Tambahan</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengaduans as $pengaduan)
                        <tr>

                            <td>{{ $pengaduan->tanggal_pengaduan }}</td>
                            <td>
                                @if ($pengaduan->identitas_pengaduan == 'Lengkap')
                                    <a href="javascript:void(0)"
                                        class="link-offset-2 link-underline link-underline-opacity-0 text-dark"
                                        data-bs-toggle="modal" data-bs-target="#UnivModal"
                                        wire:click='showIdentitas({{ $pengaduan->id }})'>
                                        {{ $pengaduan->identitas_pengaduan }}
                                        <br>
                                        <small class="text-danger" style="font-size: 0.7rem;">Click
                                            For Info</small>
                                    </a>
                                @else
                                    {{ $pengaduan->identitas_pengaduan }}
                                @endif
                            </td>
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
                                        class="link-offset-2 link-underline link-underline-opacity-0"
                                        data-bs-toggle="modal" data-bs-target="#UnivModal"
                                        wire:click='showIsiPengaduan({{ $pengaduan->id }})'>
                                        <div class="text-dark d-inline-block text-truncate" style="max-width: 150px;">
                                            {{ $pengaduan->isi_pengaduan }}</div><br>
                                        Lihat Selengkapnya
                                    </a>
                                @else
                                    <a href="javascript:void(0)"
                                        class="link-offset-2 link-underline link-underline-opacity-0"
                                        data-bs-toggle="modal" data-bs-target="#UnivModal"
                                        wire:click='showIsiPengaduan({{ $pengaduan->id }})'>
                                        <div class="text-dark d-inline-block">
                                            {{ $pengaduan->isi_pengaduan }}</div><br>
                                        Lihat Selengkapnya
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
                                                <small>Sudah Ditindak Lanjuti</small>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)"
                                                class="link-offset-2 link-underline link-underline-opacity-0 text-danger">
                                                <i class="fa-regular fa-circle-xmark"></i><br>
                                                <small>Belum Ada Tindakan</small>
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
                            <td>
                                @if (auth()->user()->role != 'UnitKerja')
                                    <a href="javascript:void(0)" class="btn btn-outline-warning border-0 btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#ModalUnit"
                                        wire:click='setidpengaduan({{ $pengaduan->id }})'>
                                        <i class="fa-solid fa-share"></i> <br> Teruskan Ke Unit
                                    </a>
                                @else
                                    @foreach ($pengaduan->pengaduanLinks as $linked)
                                        @if ($linked->unitkerja->id == auth()->user()->id)
                                            <a href="{{ route('admin.tindaklanjut', $pengaduan->id) }}"
                                                class="btn btn-outline-primary border-0 btn-sm">
                                                <i class="fa-regular fa-note-sticky"></i> <br> Tindak Lanjuti
                                            </a>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-auto">
            {{ $pengaduans->links() }}
        </div>
    </div>

    {{-- Modal Unit --}}
    <div wire:ignore.self class="modal fade" id="ModalUnit" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="teruskan">
                    <div class="modal-body">
                        <div class="row my-3">
                            <div class="col">
                                <h5>Teruskan Pengaduan Ke Unit</h5>
                            </div>
                        </div>
                        <div class="row row-cols-2">
                            @foreach ($unitskerja as $unitkerja)
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            wire:model="selectedUnits.{{ $unitkerja->id }}"
                                            value="{{ $unitkerja->id }}">
                                        <label class="form-check-label" for="unit-{{ $unitkerja->id }}">
                                            {{ $unitkerja->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Info --}}
    <div wire:ignore.self class="modal fade" id="UnivModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    @if ($isipengaduanindicator)
                        <h5 class="modal-title" id="exampleModalLabel">Isi Pengaduan</h5>
                        @if ($this->isitempat)
                            <h6>Tempat :</h6>
                            <p class="text-break">
                                {{ $this->isitempat }}
                            </p>

                            <h6>Deskripsi :</h6>
                        @endif
                        <p class="text-break">
                            {{ $this->isipengaduan }}
                        </p>
                    @elseif($identitasindicator)
                        <div class="row">
                            <div class="col">
                                Nama: {{ $this->nama_pengadu }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Phone : {{ $this->no_telp_pengadu }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Email: {{ $this->email_pengadu }}
                            </div>
                        </div>
                    @elseif($gambarindicator)
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <img src="{{ asset($this->gambar) }}" alt="Foto Pengaduan" class="img-fluid"
                                    width="300">
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
                        Nothings New
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>