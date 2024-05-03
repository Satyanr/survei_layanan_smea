<div>
    <div class="row mb-3 px-5 border">
        <div class="col">
            <div class="row">
                <div class="col">
                    <strong> Aduan Dari: @if ($pengaduan->nama_pengadu)
                            {{ $pengaduan->nama_pengadu }}
                            @else{{ $pengaduan->identitas_pengaduan }}
                        @endif </strong>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <strong>Isi Aduan:</strong>
                    <p class="text-break" style="width: 80%">{{ $pengaduan->isi_pengaduan }}</p>
                </div>
            </div>
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
            <form>
                <div class="row">
                    <div class="col">
                        <h4>Tanggapan</h4>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <label class="form-label"><strong> Foto Jika Ada </strong></label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <input type="file" class="form-control" wire:model='bukti_foto'>
                                <div wire:loading wire:target="bukti_foto">Uploading...</div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($pengaduan->tentang == 'Kerusakan')
                    <div class="row px-5">
                        <div class="col mb-3">
                            <label class="form-label"><strong> Penyebab </strong></label>
                            <textarea wire:model='penyebab' class="form-control @error('penyebab') is-invalid @enderror" rows="2"></textarea>
                            @error('penyebab')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col mb-3">
                            <label class="form-label"><strong> Koreksi </strong></label>
                            <textarea wire:model='koreksi' class="form-control @error('koreksi') is-invalid @enderror" rows="2"></textarea>
                            @error('koreksi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                @endif

                <div class="row px-5">
                    <div class="col mb-3">
                        <label class="form-label"><strong> Tindakan Korektif </strong></label>
                        <textarea wire:model='tinkor' class="form-control @error('tinkor') is-invalid @enderror" rows="2"></textarea>
                        @error('tinkor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col mb-3">
                        <label class="form-label"><strong> Tinjauan </strong></label>
                        <textarea wire:model='tinjauan' class="form-control @error('tinjauan') is-invalid @enderror" rows="2"></textarea>
                        @error('tinjauan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row px-5">
                    <div class="col mb-3">
                        <label class="form-label"><strong> Kesimpulan </strong></label>
                        <textarea wire:model='kesimpulan' class="form-control @error('kesimpulan') is-invalid @enderror" rows="2"></textarea>
                        @error('kesimpulan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-between px-5">
                    <div class="col-auto text-center mt-2">
                        <a href="{{ route('admin.daftarpengaduan', $pengaduan->tentang) }}"
                            class="btn btn-secondary d-flex m-auto mt-4">Kembali</a>
                    </div>
                    <div class="col-auto text-center mt-2">
                        <button type="button" class="btn btn-primary d-flex m-auto mt-4" wire:click='store'
                            wire:loading.attr="disabled" wire:target='bukti_foto'>Kirim
                            Tindakan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
