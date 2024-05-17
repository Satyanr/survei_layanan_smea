<nav class="navbar fixed-top navbar-expand-lg" style="background-color: #2F5296 ">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.index') }}">
            <img src="/favicon.png" alt="Logo" width="36" height="36">
            <span class="text-white">
                Layanan SMKN 1 Ciamis
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <div class="row me-2" style="margin-left: auto;">
                @if (auth()->user())
                    @if (auth()->user()->role == 'SuperAdmin' || auth()->user()->role == 'Admin' || auth()->user()->role == 'Fastingkom')
                        @if (auth()->user()->role == 'SuperAdmin' || auth()->user()->role == 'Admin')
                            <div class="col d-flex mt-2">
                                <div class="dropdown">
                                    <a class="btn btn-outline-light border-0 dropdown-toggle" href="javascript:void:(0)"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user"></i>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('admin.pengguna') }}"><i
                                                    class="fa-solid fa-user-group"></i> Pengguna</a></li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                                <i class="fa fa-key"></i> Log Out</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if (auth()->user()->role == 'Fastingkom')
                            <div class="col">
                                <a class="btn btn-outline-light border-0" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    <i class="fa fa-key"></i> <br> Keluar
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @endif
                        <div class="col d-flex">
                            <a class="btn btn-outline-light border-0" href="{{ route('admin.kategori') }}">
                                <i class="fa-solid fa-table-list"></i> Kategori
                            </a>
                        </div>
                    @else
                        <div class="col d-flex">
                            <a class="btn btn-outline-light border-0" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                <i class="fa fa-key"></i> <br> Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endif

                    @if (session('original_user_id'))
                        <div class="col d-flex">
                            <a class="btn btn-outline-light border-0" href="{{ route('admin.stop-impersonating') }}">
                                <i class="fa fa-key"></i> <span>Berhenti</span>
                            </a>
                        </div>
                    @endif
                @else
                    {{-- <div class="col d-flex me-2" style="margin-left: auto;">
                        <a href="{{ route('login') }}" class="btn btn-outline-light border-0">
                            <i class="fas fa-user"></i> Login
                        </a>
                    </div> --}}
                    {{-- <div class="col d-flex me-2" style="margin-left: auto;">
                        <a href="{{ route('login') }}" class="btn btn-outline-light border-0">
                            <div class="row">
                                <div class="col">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    Tentang
                                </div>
                            </div>
                        </a>
                    </div> --}}
                @endif
                <div class="col d-flex me-2" style="margin-left: auto;">
                    <a href="
                        @if (auth()->user()) {{ route('admin.menulaporan') }}
                        @else
                        {{ route('main.laporan') }} @endif"
                        class="btn btn-outline-light border-0">
                        <div class="row">
                            <div class="col">
                                <i class="fa-solid fa-clipboard-list"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                @if (auth()->user())
                                    Laporan
                                @else
                                    Informasi
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col d-flex me-2" style="margin-left: auto;">
                    <a href="
                    @if (auth()->user()) {{ route('admin.index') }}
                    @else
                    {{ route('main.index') }} @endif "
                        class="btn btn-outline-light border-0" type="button">
                        <div class="row">
                            <div class="col">
                                <i class="fas fa-home"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Beranda
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
