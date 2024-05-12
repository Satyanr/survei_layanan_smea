<div>
    <div class="row mb-5">
        <div class="col ms-3 text-center">
            <img src="/img/dbadmin_asst.png" alt="" width="400">
        </div>
        <div class="col m-auto">
            @if (auth()->user()->role == 'UnitKerja')
                <div class="row row-cols-1 text-center">
                    <div class="col mb-3">
                        <div class="card shadow bg-body-tertiary rounded-2 border-0">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Laporan</h5>
                                <p class="card-text"><b>{{ $unitkerja }} </b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card shadow bg-body-tertiary rounded-2 border-0">
                            <div class="card-body">
                                <h5 class="card-title">Sudah Ditindak Lanjuti</h5>
                                <p class="card-text"><b>{{ $tindaklanjut }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row row-cols-2 text-center">
                    <div class="col mb-3">
                        <div class="card shadow bg-body-tertiary rounded-2 border-0">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Laporan</h5>
                                <p class="card-text"><b>{{ $pengaduan->count() }} </b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card shadow bg-body-tertiary rounded-2 border-0">
                            <div class="card-body">
                                <h5 class="card-title">Belum Di Sampaikan</h5>
                                <p class="card-text"><b>{{ $notLinked->count() }}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card shadow bg-body-tertiary rounded-2 border-0">
                            <div class="card-body">
                                <h5 class="card-title">Belum Di Tindak</h5>
                                <p class="card-text"><b>{{ $pengaduanCount->count() }}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card shadow bg-body-tertiary rounded-2 border-0">
                            <div class="card-body">
                                <h5 class="card-title">Telah Di Tindak</h5>
                                <p class="card-text"><b>{{ $ditindak }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row text-center">

    </div>
</div>
