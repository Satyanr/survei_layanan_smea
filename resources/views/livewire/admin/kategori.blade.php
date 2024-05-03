<div>
    <div class="row">
        <div class="col">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    {{-- <div class="row mb-3">
        <div class="col">
            <h4 class="text-center">Keterangan</h4>
            <div class="row justify-content-center">
                <div class="col-auto px-3">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Klik untuk melihat keterangan KODE
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
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
        </div>
    </div> --}}
    <div class="row justify-content-between">
        <div class="col text-center">
            <div class="row justify-content-between">
                <div class="col">
                    <h4>Kategori</h4>
                </div>
                <div class="col-auto">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control" placeholder="Cari Kategori"
                            aria-label="Cari Kategori" aria-describedby="basic-addon1" wire:model='searchkategori'
                            wire:input='resetKategoriPage'>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form wire:submit.prevent='storeKategori'>
                        <div class="input-group mb-3">
                            <select class="form-select" wire:model='kode_kategori'>
                                <option selected>Code</option>
                                <option value="TNG1">TNG1</option>
                                <option value="TNG2">TNG2</option>
                                <option value="TNG3">TNG3</option>
                                <option value="TNG4">TNG4</option>
                                <option value="TNG5">TNG5</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Nama Kategori"
                                aria-label="Nama Kategori" aria-describedby="basic-addon2" wire:model='nama_kategori'>
                            <button class="btn btn-primary" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>KODE</th>
                                <th>Nama</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategoris as $kategori)
                                <tr>
                                    <td>{{ $kategori->kode_kategori }}</td>
                                    <td>{{ $kategori->nama }}</td>
                                    <td class="text-danger"><a href="javascript:void(0)" class="text-danger"
                                            wire:click.prevent='destroyKategori({{ $kategori->id }})'><i
                                                class="fa fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col" wire:click.prevent="changePagination('KategoriPage')">
                    {{ $kategoris->links() }}
                </div>
            </div>
        </div>
        <div class="col">
            <h4 class="text-center">Keterangan</h4>
            <div class="row justify-content-center">
                <div class="col-auto px-3">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Klik untuk melihat keterangan KODE
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
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
        </div>
        {{-- <div class="col">
            <div class="row justify-content-between">
                <div class="col">
                    <h4>Sub Kategori</h4>
                </div>
                <div class="col-auto">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control" placeholder="Cari Sub Kategori"
                            aria-label="Cari Sub Kategori" aria-describedby="basic-addon1"
                            wire:model='searchsubkategori' wire:input='resetSubKategoriPage'>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form wire:submit.prevent='storeSubKategori'>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nama SubKategori"
                            aria-label="Nama Kategori" aria-describedby="basic-addon2" wire:model='nama_subkategori'>
                            <select class="form-select" id="inputGroupSelect01" wire:model='kategori_id'>
                                <option selected>Pilih Kategori</option>
                                @foreach ($kategorisInput as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kategori Atas</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subkategoris as $subkategori)
                                <tr>
                                    <td>{{ $subkategori->nama }}</td>
                                    <td>
                                        {{ $subkategori->kategori->nama }}
                                    </td>
                                    <td class="text-danger"><a href="javascript:void(0)" class="text-danger"
                                            wire:click.prevent='destroySubKategori({{ $subkategori->id }})'><i
                                                class="fa fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col" wire:click.prevent="changePagination('SubKategoriPage')">
                    {{ $subkategoris->links() }}
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="col">
            <div class="text-white bg-warning w-100 border-0 rounded-pill text-center mt-2" wire:loading
                wire:target='changePagination'>
                Loading...
            </div>
        </div>
    </div>
</div>
