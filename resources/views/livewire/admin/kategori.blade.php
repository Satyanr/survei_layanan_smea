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
    <div class="row justify-content-between">
        <div class="col text-center">
            <div class="row justify-content-between">
                <div class="col-auto px-3">
                    <h4>Kategori</h4>
                </div>
                <div class="col d-flex justify-content-end">
                    <div class="input-group mb-3 w-75">
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
                <div class="col">
                    {{ $kategoris->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
