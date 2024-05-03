<div>
    <div class="row mb-5">
        <div class="col ms-3 text-center">
            <h2>Selamat Datang</h2>
            <img src="/img/dbadmin_asst.png" alt="" width="250">
        </div>
        @if (auth()->user()->role == 'UnitKerja')
            <div class="col">
                <h3 class="text-center">Informasi</h3>
                <div class="row">
                    <div class="col text-center">
                        <div class="row">
                            <div class="col">
                                <b>Laporan Ditujukan Pada Unit Anda</b> <br>
                                <b>{{ $unitkerja }}</b><br>
                                <b>Tindakan Anda</b><br>
                                <b>{{ $tindaklanjut }}</b><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="row text-center">
        <div class="col">
            <div class="row">
                <div class="col mb-3">
                    <div class="card shadow bg-body-tertiary rounded-4 rounded-pill border-0">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Pengaduan</h5>
                            <p class="card-text"><b>{{ $pengaduan->count() }}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card shadow bg-body-tertiary rounded-4 rounded-pill border-0">
                        <div class="card-body">
                            <h5 class="card-title">Belum Di Sampaikan</h5>
                            <p class="card-text"><b>{{ $notLinked->count() }}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card shadow bg-body-tertiary rounded-4 rounded-pill border-0">
                        <div class="card-body">
                            <h5 class="card-title">Belum Di Tindak</h5>
                            <p class="card-text"><b>{{ $pengaduanCount->count() }}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card shadow bg-body-tertiary rounded-4 rounded-pill border-0">
                        <div class="card-body">
                            <h5 class="card-title">Telah Di Tindak</h5>
                            <p class="card-text"><b>{{ $ditindak }}</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
