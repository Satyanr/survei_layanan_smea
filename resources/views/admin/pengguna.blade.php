@extends('layouts.admin')

@push('css')
@endpush

@section('content')
    <div class="container my-4">
        <div class="shadow p-3 my-5 bg-body-tertiary rounded-4">
            @livewire('admin.pengguna')
        </div>
    </div>
@endsection

@push('js')
@endpush