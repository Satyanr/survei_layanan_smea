<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <h1>Laporan Data Layanan</h1>
    <h5 style="color: grey">Periode @if ($start == $end)
        {{ $start }}
    @else
        {{ $start }} Sampai {{ $end }}
    @endif
</h5>

    <table>
        <tr>
            <td>Kerusakan</td>
            <td>:</td>
            <td>{{ $pengaduan->where('tentang', 'Kerusakan')->count() }}</td>
            <td>Pengaduan</td>
            <td>:</td>
            <td>{{ $pengaduan->where('tentang', 'Pengaduan')->count() }}</td>
        </tr>
        <tr>
            <td>Permintaan Informasi</td>
            <td>:</td>
            <td>
                {{ $pengaduan->where('tentang', 'Permintaan Informasi')->count() }}</td>
            <td>Saran</td>
            <td>:</td>
            <td>{{ $pengaduan->where('tentang', 'Saran')->count() }}</td>
        </tr>
    </table>

    <h4>1. Kerusakan</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Tempat</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengaduan->where("tentang", "Kerusakan") as $aduan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $aduan->updated_at->format('d-m-y') }}</td>
                    <td>{{ $aduan->tempat }}</td>
                    <td>{{ $aduan->isi_pengaduan }}</td>
                    <td>{{ $aduan->kategori }}</td>
                    <td>
                        <img src="{{ public_path($aduan->bukti_foto) }}" width="50%" alt="">
                    </td>                    
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak Ada Laporan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <h4>2. Pengaduan</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Identitas</th>
                <th>Isi Aduan</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengaduan->where("tentang", "Pengaduan") as $aduan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $aduan->updated_at->format('d-m-y') }}</td>
                    <td>{{ $aduan->identitas_pengaduan }}</td>
                    <td>{{ $aduan->isi_pengaduan }}</td>
                    <td>{{ $aduan->kategori }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak Ada Laporan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <h4>3. Saran</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Identitas</th>
                <th>Isi Saran</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengaduan->where("tentang", "Saran") as $aduan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $aduan->updated_at->format('d-m-y') }}</td>
                    <td>{{ $aduan->identitas_pengaduan }}</td>
                    <td>{{ $aduan->isi_pengaduan }}</td>
                    <td>{{ $aduan->kategori }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak Ada Laporan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <h4>4. Permintaan Informasi</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Identitas</th>
                <th>Kontak</th>
                <th>Isi Permintaan</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengaduan->where("tentang", "Permintaan Informasi") as $aduan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $aduan->updated_at->format('d-m-y') }}</td>
                    <td>
                        @if ($aduan->identitas_pengaduan == 'Lengkap')
                            {{ $aduan->nama_pengadu }}
                        @else
                            {{ $aduan->identitas_pengaduan }}
                        @endif
                    </td>
                    <td>
                        @if ($aduan->identitas_pengaduan == 'Lengkap')
                            {{ $aduan->no_telp_pengadu }},  
                            {{ $aduan->email_pengadu }}  
                        @else
                            Tidak Tersedia
                        @endif
                    </td>
                    <td>{{ $aduan->isi_pengaduan }}</td>
                    <td>{{ $aduan->kategori }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak Ada Laporan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
