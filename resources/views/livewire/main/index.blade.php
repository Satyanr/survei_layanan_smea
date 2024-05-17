<div>
    <div class="row text-center mb-4">
        <div class="col">
            <h2>Lengkapi Data Keperluan Anda</h2>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-auto">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <div class="row text-center">
                    <div class="col">
                        <label class="form-label fs-5"><strong> Perihal </strong></label>
                    </div>
                </div>
                <div class="row text-center pb-5 fs-5">
                    <div class="col d-flex justify-content-center">
                        <div class="form-control p-3 w-75">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('tentang') is-invalid @enderror" type="radio"
                                    id="pengaduan" value="Pengaduan" wire:click="tentoff" wire:model='tentang'>
                                <label class="form-check-label" for="Pengaduan">Pengaduan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('tentang') is-invalid @enderror" type="radio"
                                    id="Informasi" value="Permintaan Informasi" wire:click="tentoff"
                                    wire:model='tentang'>
                                <label class="form-check-label" for="Informasi">Permintaan Informasi</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('tentang') is-invalid @enderror" type="radio"
                                    id="Saran" value="Saran" wire:click="tentoff" wire:model='tentang'>
                                <label class="form-check-label" for="Saran">Saran</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('tentang') is-invalid @enderror" type="radio"
                                    id="kerusakan" value="Kerusakan" wire:click="tenton" wire:model='tentang'>
                                <label class="form-check-label" for="kerusakan">Kerusakan</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col">
                        <label class="form-label fs-5"><strong> Identitas </strong></label>
                    </div>
                </div>
                <div class="row text-center pb-5 fs-5">
                    <div class="col d-flex justify-content-center">
                        <div class="form-control p-3 w-75">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('identitas_pengaduan') is-invalid @enderror"
                                    type="radio" name="inlineRadioOptions" id="lengkap" value="Lengkap"
                                    wire:model='identitas_pengaduan' wire:click="idon">
                                <label class="form-check-label" for="lengkap">Lengkap</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('identitas_pengaduan') is-invalid @enderror"
                                    type="radio" name="inlineRadioOptions" id="Siswa" value="Siswa"
                                    wire:model='identitas_pengaduan' wire:click='idoff'>
                                <label class="form-check-label" for="Siswa">Siswa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('identitas_pengaduan') is-invalid @enderror"
                                    type="radio" name="inlineRadioOptions" id="Tamu" value="Tamu"
                                    wire:model='identitas_pengaduan' wire:click='idoff'>
                                <label class="form-check-label" for="Tamu">Tamu</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('identitas_pengaduan') is-invalid @enderror"
                                    type="radio" name="inlineRadioOptions" id="PenggunaFasilitas"
                                    value="Pengguna Fasilitas" wire:model='identitas_pengaduan' wire:click='idoff'>
                                <label class="form-check-label" for="PenggunaFasilitas">Pengguna Fasilitas</label>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col">
                        <div class="mb-3">
                            <label class="form-label"><strong> Sub Kategori </strong></label>
                            <select class="form-select @error('subkategori') is-invalid @enderror"
                                wire:model="subkategori" required wire:loading.attr='disabled' wire:target='kategori'>
                                <option value="">Pilih Sub Kategori</option>
                                @foreach ($subkategoris as $subkategori)
                                    @if ($subkategori->kategori->nama == $this->kategori)
                                        <option value="{{ $subkategori->nama }}">
                                            {{ $subkategori->nama }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="text-white bg-warning border-0 rounded-pill w-25 text-center mt-2" wire:loading
                                wire:target='kategori'>
                                Loading...
                            </div>
                            @error('subkategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div> --}}
        </div>

        {{-- <div class="row mb-3">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <label class="form-label"><strong> Identitas </strong></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('identitas_pengaduan') is-invalid @enderror"
                                        type="radio" name="inlineRadioOptions" id="lengkap" value="Lengkap"
                                        wire:model='identitas_pengaduan' wire:click="idon">
                                    <label class="form-check-label" for="lengkap">Lengkap</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('identitas_pengaduan') is-invalid @enderror"
                                        type="radio" name="inlineRadioOptions" id="Siswa"
                                        value="Siswa" wire:model='identitas_pengaduan' wire:click='idoff'>
                                    <label class="form-check-label" for="Siswa">Siswa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('identitas_pengaduan') is-invalid @enderror"
                                        type="radio" name="inlineRadioOptions" id="Tamu" value="Tamu"
                                        wire:model='identitas_pengaduan' wire:click='idoff'>
                                    <label class="form-check-label" for="Tamu">Tamu</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('identitas_pengaduan') is-invalid @enderror"
                                        type="radio" name="inlineRadioOptions" id="PenggunaFasilitas"
                                        value="Pengguna Fasilitas" wire:model='identitas_pengaduan'
                                        wire:click='idoff'>
                                    <label class="form-check-label" for="PenggunaFasilitas">Pengguna Fasilitas</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="row">
                            <div class="col">
                                <label class="form-label"><strong> Foto
                                        @if ($this->tentangon)
                                            Wajib Diisi
                                        @else
                                            Jika Ada
                                        @endif
                                    </strong></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="file" class="form-control @error('bukti_foto') is-invalid @enderror"
                                    wire:model='bukti_foto'>
                                @error('bukti_foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div wire:loading wire:target="bukti_foto">Uploading...</div>
                            </div>
                        </div>
                    </div>
                </div> --}}
        @if ($identitason)
            <div class="row my-3 justify-content-center">
                <div class="col-auto">
                    <div class="mb-3">
                        <label class="form-label"><strong> Nama </strong></label>
                        <input type="input" class="form-control @error('nama_pengadu') is-invalid @enderror"
                            wire:model='nama_pengadu' required>
                        @error('nama_pengadu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-auto">
                    <div class="mb-3">
                        <label class="form-label"><strong> Kontak </strong></label>
                        <div class="row">
                            <div class="col">
                                <input type="text"
                                    class="form-control @error('no_telp_pengadu') is-invalid
                                        @enderror"
                                    wire:model='no_telp_pengadu' placeholder="Nomor Telpon" required>
                                @error('no_telp_pengadu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col">
                                <input type="text"
                                    class="form-control @error('email_pengadu') is-invalid
                                        @enderror"
                                    wire:model='email_pengadu' placeholder="Email" required>
                                @error('email_pengadu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label"><strong> Kategori </strong></label>
                    <select class="form-select @error('kategori') is-invalid @enderror" wire:model="kategori"
                        required wire:loading.attr='disabled' wire:target='tentang' required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoris as $kategorilist)
                            <option value="{{ $kategorilist->nama }}">
                                {{ $kategorilist->nama }}
                            </option>
                        @endforeach
                    </select>
                    <div class="text-white bg-warning border-0 rounded-pill w-50 text-center mt-2" wire:loading
                        wire:target='tentang'>
                        Loading...
                    </div>
                    @error('kategori')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-auto">
                <div class="row">
                    <div class="col">
                        <label class="form-label"><strong> Foto
                                @if ($this->tentangon)
                                    Wajib Diisi
                                @else
                                    Jika Ada
                                @endif
                            </strong></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="file" class="form-control @error('bukti_foto') is-invalid @enderror"
                            wire:model='bukti_foto'>
                        @error('bukti_foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div wire:loading wire:target="bukti_foto">Uploading...</div>
                    </div>
                </div>
            </div>
        </div>
        @if ($tentangon)
            <div class="row my-3 ps-4">
                <div class="col">
                    <div class="mb-3">
                        <label class="form-label"><strong> Tempat </strong></label>
                        <input type="input" placeholder="Sertakan Lantai, Nomor/Nama Ruangan"
                            class="form-control @error('tempat') is-invalid @enderror" wire:model='tempat' required>
                        @error('tempat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        @endif
        <div class="row m-auto">
            <div class="col">
                <label class="form-label"><strong> Isi Keperluan Anda </strong></label>
                <textarea wire:model='isi_pengaduan' class="form-control @error('isi_pengaduan') is-invalid @enderror"
                    rows="4"></textarea>
                @error('isi_pengaduan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-auto text-center mt-2" style="margin-left: auto">
                <button type="submit" class="btn btn-primary d-flex m-auto mt-4" wire:loading.attr="disabled"
                    wire:target='bukti_foto'>Kirimkan</button>
            </div>
        </div>
        @error('tentang')
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('identitas_pengaduan')
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        </form>
    </div>
</div>
</div>
