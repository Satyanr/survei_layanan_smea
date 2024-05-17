<div>
    <div class="row m-3">
        <div class="col-auto text-center">
            <img src="/img/dbadmin_asst.png" alt="" width="350">
        </div>
        <div class="col m-auto">
            @if (auth()->user()->role == 'UnitKerja')
                <div class="row row-cols-1 text-center">
                    <div class="col mb-3">
                        <div class="card shadow bg-body-tertiary rounded-2 border-0">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Laporan</h5>
                                <p class="card-text fs-4"><b>{{ $unitkerja }} </b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card shadow bg-body-tertiary rounded-2 border-0">
                            <div class="card-body">
                                <h5 class="card-title">Sudah Ditindak Lanjuti</h5>
                                <p class="card-text fs-4"><b>{{ $tindaklanjut }}</b></p>
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
                                <p class="card-text fs-4"><b>{{ $pengaduan->count() }} </b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card shadow bg-body-tertiary rounded-2 border-0">
                            <div class="card-body">
                                <h5 class="card-title">Belum Di Sampaikan</h5>
                                <p class="card-text fs-4"><b>{{ $notLinked->count() }}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow bg-body-tertiary rounded-2 border-0">
                            <div class="card-body">
                                <h5 class="card-title">Belum Di Tindak</h5>
                                <p class="card-text fs-4"><b>{{ $pengaduanCount->count() }}</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow bg-body-tertiary rounded-2 border-0">
                            <div class="card-body">
                                <h5 class="card-title">Telah Di Tindak</h5>
                                <p class="card-text fs-4"><b>{{ $ditindak }}</b></p>
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
