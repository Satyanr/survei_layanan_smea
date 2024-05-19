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
            <td style="border: none; text-align:left">{{ $pengaduan->where('tentang', 'Permintaan Informasi')->count() }}</td>
            <td style="border: none; text-align:left">Saran</td>
            <td style="width: 5%; border: none">:</td>
            <td style="border: none; text-align:left">{{ $pengaduan->where('tentang', 'Saran')->count() }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Identitas</th>
                <th>Tentang</th>
                <th>Isi Aduan</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengaduan as $aduan)
                <tr>
                    <td style="width: 5%">{{ $loop->iteration }}</td>
                    <td style="width: 10%">{{ $aduan->updated_at->format('d-m-y') }}</td>
                    <td style="width: 15%">{{ $aduan->identitas_pengaduan }}</td>
                    <td>{{ $aduan->tentang }}</td>
                    <td class="warptxt">{{ $aduan->isi_pengaduan }}</td>
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
