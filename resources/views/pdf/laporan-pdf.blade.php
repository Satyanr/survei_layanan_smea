<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #000;
            text-align: center;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
        }

        td.warptxt {
            word-wrap: break-word;
            white-space: normal;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center">Laporan Data Layanan</h1>

    <table style="width:100%; padding-bottom: 10px;">
        <tr>
            <td style="border: none; text-align:left">Kerusakan</td>
            <td style="width: 5%; border: none">:</td>
            <td style="border: none; text-align:left">{{ $pengaduan->where('tentang', 'Kerusakan')->count() }}</td>
            <td style="border: none; text-align:left">Pengaduan</td>
            <td style="width: 5%; border: none">:</td>
            <td style="border: none; text-align:left">{{ $pengaduan->where('tentang', 'Pengaduan')->count() }}</td>
        </tr>
        <tr>
            <td style="border: none; text-align:left">Permintaan Informasi</td>
            <td style="width: 5%; border: none">:</td>
            <td style="border: none; text-align:left">
                {{ $pengaduan->where('tentang', 'Permintaan Informasi')->count() }}</td>
            <td style="border: none; text-align:left">Saran</td>
            <td style="width: 5%; border: none">:</td>
            <td style="border: none; text-align:left">{{ $pengaduan->where('tentang', 'Saran')->count() }}</td>
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
                    <td style="width: 5%">{{ $loop->iteration }}</td>
                    <td style="width: 10%">{{ $aduan->updated_at->format('d-m-y') }}</td>
                    <td style="width: 15%">{{ $aduan->tempat }}</td>
                    <td class="warptxt">{{ $aduan->isi_pengaduan }}</td>
                    <td style="width: 15%">{{ $aduan->kategori }}</td>
                    <td>
                        <img src="{{ public_path($aduan->bukti_foto) }}" alt="" style="width: 100px;">
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
                    <td style="width: 5%">{{ $loop->iteration }}</td>
                    <td style="width: 10%">{{ $aduan->updated_at->format('d-m-y') }}</td>
                    <td style="width: 15%">{{ $aduan->identitas_pengaduan }}</td>
                    <td class="warptxt">{{ $aduan->isi_pengaduan }}</td>
                    <td style="width: 15%">{{ $aduan->kategori }}</td>
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
                    <td style="width: 5%">{{ $loop->iteration }}</td>
                    <td style="width: 10%">{{ $aduan->updated_at->format('d-m-y') }}</td>
                    <td style="width: 15%">{{ $aduan->identitas_pengaduan }}</td>
                    <td class="warptxt">{{ $aduan->isi_pengaduan }}</td>
                    <td style="width: 15%">{{ $aduan->kategori }}</td>
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
                    <td style="width: 5%">{{ $loop->iteration }}</td>
                    <td style="width: 10%">{{ $aduan->updated_at->format('d-m-y') }}</td>
                    <td style="width: 15%">
                        @if ($aduan->identitas_pengaduan == 'Lengkap')
                            {{ $aduan->nama_pengadu }}
                        @else
                            {{ $aduan->identitas_pengaduan }}
                        @endif
                    </td>
                    <td class="warptxt">
                        @if ($aduan->identitas_pengaduan == 'Lengkap')
                            {{ $aduan->no_telp_pengadu }}  
                            {{ $aduan->email_pengadu }}  
                        @else
                            Tidak Tersedia
                        @endif
                    </td>
                    <td class="warptxt">{{ $aduan->isi_pengaduan }}</td>
                    <td style="width: 15%">{{ $aduan->kategori }}</td>
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
