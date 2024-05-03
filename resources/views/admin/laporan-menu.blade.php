@extends('layouts.admin')

@push('css')
@endpush

@section('content')
    <div class="container mt-5 pt-5 justify-content-center">
        <div class="shadow p-3 mb-5 bg-body-tertiary rounded-4">
            <div class="row mb-3">
                <div class="col">
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
                {{-- <div class="col justify-content-center d-flex">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#LaporanPengaduanModal">
                        Laporan Pengaduan Masyarakat <i class="fa-solid fa-file-word"></i>
                    </button>
                </div>
                <div class="col justify-content-center d-flex">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#LaporanMonevModal">
                        Laporan Tindak Lanjut <i class="fa-solid fa-file-word"></i>
                    </button>
                </div> --}}
            </div>
        </div>
        <div class="row row-cols-2 text-center">
            <div class="col">
                <a href="{{ route('admin.daftarpengaduan', 'Permintaan Informasi') }}" style="text-decoration: none;">
                    <div class="shadow p-3 mb-5 bg-body-tertiary rounded-4" style="height: 20vh">
                        <div class="text-primary">
                            <h3>
                                <i class="fa-solid fa-file-circle-question"></i><br>
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
                                @if (auth()->user()->role == 'UnitKerja')
                                    @if ($pengaduanBelumTindak->count() > 0)
                                        <span
                                            class="badge text-bg-danger rounded-circle">{{ $pengaduanBelumTindak->count() }}</span>
                                    @endif
                                @else
                                    @if ($pengaduansNotLinked->count() > 0)
                                        <span
                                            class="badge text-bg-danger rounded-circle">{{ $pengaduansNotLinked->count() }}</span>
                                    @endif
                                @endif
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('admin.daftarpengaduan', 'Saran') }}" style="text-decoration: none;">
                    <div class="shadow p-3 mb-5 bg-body-tertiary rounded-4" style="height: 20vh">
                        <div class="text-warning">
                            <h3>
                                <i class="fa-solid fa-hands-holding-circle"></i><br>
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
                                @if (auth()->user()->role == 'UnitKerja')
                                    @if ($pengaduanBelumTindak->count() > 0)
                                        <span
                                            class="badge text-bg-danger rounded-circle">{{ $pengaduanBelumTindak->count() }}</span>
                                    @endif
                                @else
                                    @if ($pengaduansNotLinked->count() > 0)
                                        <span
                                            class="badge text-bg-danger rounded-circle">{{ $pengaduansNotLinked->count() }}</span>
                                    @endif
                                @endif
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('admin.daftarpengaduan', 'Pengaduan') }}" style="text-decoration: none;">
                    <div class="shadow p-3 mb-5 bg-body-tertiary rounded-4" style="height: 20vh">
                        <div class="text-danger">
                            <h3>
                                <i class="fa-solid fa-file-circle-exclamation"></i><br>
                                @php
                                    $pengaduansNotLinked = \App\Models\Pengaduan::notHaveLinked()
                                        ->where('tentang', 'Pengaduan')
                                        ->get();
                                    $pengaduanBelumTindak = \App\Models\Pengaduan::where('tentang', 'Pengaduan')
                                        ->whereHas('pengaduanLinks', function ($query) {
                                            $query->where('user_id', auth()->user()->id);
                                        })
                                        ->NotHaveTindakLanjut()
                                        ->get();
                                @endphp
                                Pengaduan
                                @if (auth()->user()->role == 'UnitKerja')
                                    @if ($pengaduanBelumTindak->count() > 0)
                                        <span
                                            class="badge text-bg-danger rounded-circle">{{ $pengaduanBelumTindak->count() }}</span>
                                    @endif
                                @else
                                    @if ($pengaduansNotLinked->count() > 0)
                                        <span
                                            class="badge text-bg-danger rounded-circle">{{ $pengaduansNotLinked->count() }}</span>
                                    @endif
                                @endif
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('admin.daftarpengaduan', 'Kerusakan') }}" style="text-decoration: none;">
                    <div class="shadow p-3 mb-5 bg-body-tertiary rounded-4" style="height: 20vh">
                        <div class="text-danger">
                            <h3>
                                <i class="fa-solid fa-heart-crack"></i><br>
                                @php
                                    $pengaduansNotLinked = \App\Models\Pengaduan::notHaveLinked()
                                        ->where('tentang', 'Kerusakan')
                                        ->get();
                                    $pengaduanBelumTindak = \App\Models\Pengaduan::where('tentang', 'Kerusakan')
                                        ->whereHas('pengaduanLinks', function ($query) {
                                            $query->where('user_id', auth()->user()->id);
                                        })
                                        ->NotHaveTindakLanjut()
                                        ->get();
                                @endphp
                                Kerusakan
                                @if (auth()->user()->role == 'UnitKerja')
                                    @if ($pengaduanBelumTindak->count() > 0)
                                        <span
                                            class="badge text-bg-danger rounded-circle">{{ $pengaduanBelumTindak->count() }}</span>
                                    @endif
                                @else
                                    @if ($pengaduansNotLinked->count() > 0)
                                        <span
                                            class="badge text-bg-danger rounded-circle">{{ $pengaduansNotLinked->count() }}</span>
                                    @endif
                                @endif
                            </h3>
                        </div>
                    </div>
                </a>
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
