@extends('layouts.admin')

@push('css')
@endpush

@section('content')
    <div class="container mt-5 justify-content-center">
        <div class="shadow p-3 mb-5 bg-body-tertiary rounded-4">
            @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'SuperAdmin')
                <div class="row mb-3 ps-3">
                    <div class="col bg-white">
                        <form action="{{ route('laporan-pengaduan-masyarakat') }}" method="GET">
                            <div class="row py-3">
                                <div class="col">
                                    <h5>Cetak Laporan</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="start" id="start" required>
                                    <span class="input-group-text">sampai</span>
                                    <input type="date" class="form-control" name="end" id="end" required>

                                    <button class="btn btn-primary" type="submit">Unduh</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-auto me-3 bg-white">
                        <img src="/img/lprnpage_asset.png" alt="" width="300">
                    </div>
                </div>
            @endif

            <div class="row text-center">
                <div class="col">
                    <a href="{{ route('admin.daftarpengaduan', 'Permintaan Informasi') }}" style="text-decoration: none;">
                        <div class="card border-1 rounded-2  d-flex flex-column h-100">
                            <div class="card-body">
                                <div class="row h-75 pb-3">
                                    <div class="col">
                                        <img src="/img/PInformasi.png" class="img-fluid" alt="...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h5>
                                            @php
                                                $pengaduansNotLinked = \App\Models\Pengaduan::notHaveLinked()
                                                    ->where('tentang', 'Permintaan Informasi')
                                                    ->get();
                                                $pengaduanBelumTindak = \App\Models\Pengaduan::where(
                                                    'tentang',
                                                    'Permintaan Informasi',
                                                )
                                                    ->whereHas('pengaduanLinks', function ($query) {
                                                        $query->where('user_id', auth()->user()->id);
                                                    })
                                                    ->NotHaveTindakLanjut()
                                                    ->get();
                                            @endphp
                                            Permintaan Informasi
                                        </h5>
                                        @if (auth()->user()->role == 'UnitKerja')
                                            @if ($pengaduanBelumTindak->count() > 0)
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $pengaduanBelumTindak->count() }}</span>
                                            @endif
                                        @else
                                            @if ($pengaduansNotLinked->count() > 0)
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $pengaduansNotLinked->count() }}</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('admin.daftarpengaduan', 'Saran') }}" style="text-decoration: none;">
                        <div class="card border-1 rounded-2  d-flex flex-column h-100">
                            <div class="card-body">
                                <div class="row h-75 pb-3">
                                    <div class="col">
                                        <img src="/img/Saran.png" class="img-fluid" alt="...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h5>
                                            @php
                                                $pengaduansNotLinked = \App\Models\Pengaduan::notHaveLinked()
                                                    ->where('tentang', 'Saran')
                                                    ->get();
                                                $pengaduanBelumTindak = \App\Models\Pengaduan::where('tentang', 'Saran')
                                                    ->whereHas('pengaduanLinks', function ($query) {
                                                        $query->where('user_id', auth()->user()->id);
                                                    })
                                                    ->NotHaveTindakLanjut()
                                                    ->get();
                                            @endphp
                                            Saran
                                        </h5>
                                        @if (auth()->user()->role == 'UnitKerja')
                                            @if ($pengaduanBelumTindak->count() > 0)
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $pengaduanBelumTindak->count() }}</span>
                                            @endif
                                        @else
                                            @if ($pengaduansNotLinked->count() > 0)
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $pengaduansNotLinked->count() }}</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('admin.daftarpengaduan', 'Pengaduan') }}" style="text-decoration: none;">
                        <div class="card border-1 rounded-2  d-flex flex-column h-100">
                            <div class="card-body">
                                <div class="row h-75 pb-3">
                                    <div class="col">
                                        <img src="/img/Pengaduan.png" class="img-fluid" alt="...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h5>
                                            @php
                                                $pengaduansNotLinked = \App\Models\Pengaduan::notHaveLinked()
                                                    ->where('tentang', 'Pengaduan')
                                                    ->get();
                                                $pengaduanBelumTindak = \App\Models\Pengaduan::where(
                                                    'tentang',
                                                    'Pengaduan',
                                                )
                                                    ->whereHas('pengaduanLinks', function ($query) {
                                                        $query->where('user_id', auth()->user()->id);
                                                    })
                                                    ->NotHaveTindakLanjut()
                                                    ->get();
                                            @endphp
                                            Pengaduan
                                        </h5>
                                        @if (auth()->user()->role == 'UnitKerja')
                                            @if ($pengaduanBelumTindak->count() > 0)
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $pengaduanBelumTindak->count() }}</span>
                                            @endif
                                        @else
                                            @if ($pengaduansNotLinked->count() > 0)
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $pengaduansNotLinked->count() }}</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('admin.daftarpengaduan', 'Kerusakan') }}" style="text-decoration: none;">
                        <div class="card border-1 rounded-2  d-flex flex-column h-100">
                            <div class="card-body">
                                <div class="row h-75 pb-3">
                                    <div class="col">
                                        <img src="/img/PInformasi.png" class="img-fluid" alt="...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h5>
                                            @php
                                                $pengaduansNotLinked = \App\Models\Pengaduan::notHaveLinked()
                                                    ->where('tentang', 'Kerusakan')
                                                    ->get();
                                                $pengaduanBelumTindak = \App\Models\Pengaduan::where(
                                                    'tentang',
                                                    'Kerusakan',
                                                )
                                                    ->whereHas('pengaduanLinks', function ($query) {
                                                        $query->where('user_id', auth()->user()->id);
                                                    })
                                                    ->NotHaveTindakLanjut()
                                                    ->get();
                                            @endphp
                                            Kerusakan
                                        </h5>
                                        @if (auth()->user()->role == 'UnitKerja')
                                            @if ($pengaduanBelumTindak->count() > 0)
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $pengaduanBelumTindak->count() }}</span>
                                            @endif
                                        @else
                                            @if ($pengaduansNotLinked->count() > 0)
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $pengaduansNotLinked->count() }}</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Laporan Pengaduan Masyarakat -->
    {{-- <div class="modal fade" id="LaporanPengaduanModal" tabindex="-1" aria-labelledby="LaporanMonevModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="LaporanMonevModalLabel">Unduh Laporan Pengaduan Masyarakat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('laporan-pengaduan-masyarakat') }}" method="GET">
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="start" id="start" required>
                                <span class="input-group-text">to</span>
                                <input type="date" class="form-control" name="end" id="end" required>
                                <button class="btn btn-primary" type="submit">Unduh</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Modal Laporan Monev -->
    {{-- <div class="modal fade" id="LaporanMonevModal" tabindex="-1" aria-labelledby="LaporanMonevModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="LaporanMonevModalLabel">Unduh Laporan Monev</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('laporan-tinjut') }}" method="GET">
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="start" id="start" required>
                                <span class="input-group-text">to</span>
                                <input type="date" class="form-control" name="end" id="end" required>
                                <button class="btn btn-primary" type="submit">Unduh</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@push('js')
@endpush
