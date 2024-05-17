<div>
    <div class="p-5">
        <div class="row mb-5 justify-content-between">
            <div class="col-auto ms-3">
                <h3>Daftar Pengguna </h3>
            </div>
            <div class="col">
                <div class="input-group mb-3 w-75 m-auto">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control" placeholder="Cari Pengguna" aria-label="Cari Pengguna"
                        aria-describedby="basic-addon1" wire:model='searchuser' wire:input='resetPageUser'>
                </div>
            </div>
            <div class="col-auto text-center">
                <a href="javascript:void(0)" class="btn btn-primary border-0" data-bs-toggle="modal"
                    data-bs-target="#ModalAkun">
                    <b>
                        <i class="fa-solid fa-user-plus"></i>
                        <small>Tambahkan</small>
                    </b>
                </a>
            </div>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Penanggung Jawab Unit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penggunas->where('role', '!=', 'SuperAdmin') as $pengguna)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pengguna->name }}</td>
                                <td>{{ $pengguna->email }}</td>
                                <td>{{ $pengguna->role }}</td>
                                <td>{{ $pengguna->penanggung_jawab }}</td>
                                <td>
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-outline-dark border-0"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:void(0)"
                                                    data-bs-toggle="modal" data-bs-target="#ModalAkun"
                                                    wire:click='edit({{ $pengguna->id }})'><i class="fa-solid fa-pencil"></i> Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-success"
                                                    href="{{ route('admin.impersonate', $pengguna) }}"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
                                            </li>
                                            <li><a class="dropdown-item text-danger" href="javascript:void(0)"
                                                    wire:click.prevent="delete({{ $pengguna->id }})"><i class="fa-solid fa-trash"></i> Hapus</a></li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-auto">
                {{ $penggunas->links() }}
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="ModalAkun">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        @if ($updateMode)
                            <h4 class="modal-title" id="myModalLabel">Edit Akun</h4>
                        @else
                            <h4 class="modal-title" id="myModalLabel">Tambahkan Akun</h4>
                        @endif
                        <button type="button" class="close" data-dismiss="modal"
                            wire:click.prevent='cancel()'><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Unit</label>
                            <input type="text"
                                class="form-control @error('name') is-invalid
                            @enderror"
                                placeholder="Nama Unit" wire:model='name'>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"
                                class="form-control @error('email') is-invalid
                            @enderror"
                                placeholder="Email" wire:model='email'>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                @if ($updateMode)
                                    <label>Password Baru</label>
                                @else
                                    <label>Password</label>
                                @endif
                                <input type="password"
                                    class="form-control @error('password') is-invalid
                                @enderror"
                                    placeholder="Password" wire:model='password'>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Konfirmasi Password</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid
                                @enderror"
                                    placeholder="Konfirmasi Password" wire:model='password_confirmation'>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label>Role</label>
                                <select id="role"
                                    class="form-select form-select-sm @error('role') is-invalid
                                @enderror"
                                    wire:model='role' wire:change="updateRole">
                                    <option value=" ">Pilih</option>
                                    @if ($updateMode)
                                        @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'SuperAdmin')
                                            <option value="UnitKerja" {{ $role == 'UnitKerja' ? 'selected' : '' }}>Unit
                                                Kerja</option>
                                            <option value="Admin" {{ $role == 'Admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            @if (auth()->user()->role == 'SuperAdmin')
                                                <option value="SuperAdmin"
                                                    {{ $role == 'SuperAdmin' ? 'selected' : '' }}>Super Admin</option>
                                            @endif
                                        @endif
                                    @else
                                        @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'SuperAdmin')
                                            <option value="0">Unit Kerja</option>
                                            <option value="1">Admin</option>
                                            @if (auth()->user()->role == 'SuperAdmin')
                                                <option value="2">Super Admin</option>
                                            @endif
                                        @endif
                                    @endif
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @if ($unitMode)
                            {{-- <div class="form-group">
                                <label>Kode Unit</label>
                                <input type="text"
                                    class="form-control @error('kode_unit') is-invalid
                            @enderror"
                                    placeholder="Kode Unit" wire:model='kode_unit'>
                                @error('kode_unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <div class="form-group">
                                <label>Penanggung Jawab Unit</label>
                                <input type="text"
                                    class="form-control @error('penjab') is-invalid
                            @enderror"
                                    placeholder="Penanggung Jawab Unit" wire:model='penjab'>
                                @error('penjab')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text"
                                    class="form-control @error('nip') is-invalid
                            @enderror"
                                    placeholder="NIP" wire:model='nip'>
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            wire:click.prevent='cancel()'>Batal</button>
                        @if ($updateMode)
                            <button type="button" class="btn btn-primary"
                                wire:click.prevent="update()">Simpan</button>
                        @else
                            <button type="button" class="btn btn-primary"
                                wire:click.prevent="store()">Tambahkan</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
