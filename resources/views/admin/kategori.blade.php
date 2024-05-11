@extends('layouts.admin')

@push('css')
@endpush

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col">
                <div class="shadow p-3 mb-5 bg-body-tertiary rounded-4">
                    @livewire('admin.kategori')
                </div>
            </div>
            <div class="col">
                <div class="shadow p-3 mb-5 bg-body-tertiary rounded-4">
                    <h4 class="text-center">Keterangan</h4>
                    <hr class="w-75 m-auto pb-3 border-3">
                    <div class="row justify-content-center">
                        <div class="col px-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <h6>TNG1: Pengaduan</h6>
                                </li>
                                <li class="list-group-item">
                                    <h6>TNG2: Permintaan Informasi</h6>
                                </li>
                                <li class="list-group-item">
                                    <h6>TNG3: Saran</h6>
                                </li>
                                <li class="list-group-item">
                                    <h6>TNG4: Kerusakan</h6>
                                </li>
                                <li class="list-group-item">
                                    <h6>TNG5: Semuanya</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
