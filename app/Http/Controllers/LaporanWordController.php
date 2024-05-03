<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;

class LaporanWordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function LaporanTinjut(Request $request)
    {
        $monthTranslations = [
            'January' => 'JANUARI',
            'February' => 'FEBRUARI',
            'March' => 'MARET',
            'April' => 'APRIL',
            'May' => 'MEI',
            'June' => 'JUNI',
            'July' => 'JULI',
            'August' => 'AGUSTUS',
            'September' => 'SEPTEMBER',
            'October' => 'OKTOBER',
            'November' => 'NOVEMBER',
            'December' => 'DESEMBER',
        ];

        setlocale(LC_TIME, 'id_ID');
        $start = Carbon::createFromFormat('Y-m-d', $request->input('start'));
        $end = Carbon::createFromFormat('Y-m-d', $request->input('end'));

        $laporansStart = Pengaduan::whereDate('tanggal_pengaduan', $start)->get();
        $laporansRange = Pengaduan::whereBetween('tanggal_pengaduan', [$start, $end])->get();
        $laporans = $laporansStart->merge($laporansRange);

        $startMonth = $monthTranslations[$start->format('F')];
        $startYear = $start->format('Y');
        $endMonth = $monthTranslations[$end->format('F')];
        $endYear = $end->format('Y');

        $phpWord = new PhpWord();
        $phpWord->addTitleStyle(0, ['name' => 'Times New Roman', 'size' => 16], ['align' => 'center', 'indentation' => ['left' => 2510, 'right' => 634], 'spaceAfter' => 0]);
        // margin in cm for multiple with twips
        $topMarginCm = 1.9;
        $bottomMarginCm = 1.48;
        $leftMarginCm = 1.09;
        $rightMarginCm = 1.06;
        $section = $phpWord->addSection([
            'marginLeft' => $leftMarginCm * 567,
            'marginRight' => $rightMarginCm * 567,
            'marginTop' => $topMarginCm * 567,
            'marginBottom' => $bottomMarginCm * 567,
        ]);

        // $header = $section->addHeader();
        // $html = '<html><body style="font-family: Arial;">';
        // $html .= '<table border="1" style="width: 450px;"><tr><td style="width: 100px;" lign="center"><img src="' . public_path('image/twh.png') . '" width="80" height="80" /></td>';
        // $html .= '<td style="font-size: 9.5pt;" align="center" colspan="4"><p>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN <b>BALAI BESAR PENGEMBANGAN PENJAMINAN MUTU PENDIDIKAN VOKASI BIDANG MESIN DAN TEKNIK INDUSTRI</b>
        // </p></td></tr>';
        // $html .= '<tr><td colspan="2" align="center"><h1>PENGADUAN MASYARAKAT</h1></td><td style="width:100px"><table border="1"><tr><td>TestKode Dok.</td><td>TestF-8.5.2-03</td></tr><tr><td>TestKode Dok.</td><td>TestF-8.5.2-03</td></tr></table></td></tr>';
        // $html .= '</table></body></html>';
        // Html::addHtml($header, $html, false, false);

        $html = '<html><body style="font-family: Times New Roman; font-size: 11pt">';
        $html .= '<table border="0.8" style="width:100%;">';
        $html .= '<thead>';
        $html .= '<tr><th align="center" style="width: 50px;"><b>Kode.</b></th><th align="center"><b>Jenis Penyimpangan/<br></br>Ketidaksesuaian/Keluhan</b></th><th align="center" style="width: 100px;"><b>Penyebab</b></th><th align="center" style="width: 150px;"><b>Tindakan Korektif</b></th><th align="center" style="width: 120px;"><b>Tinjauan</b></th><th align="center" style="width: 120px;"><b>Kesimpulan</b></th></tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach ($laporans as $laporan) {
            $html .= '<tr><td align="center" style="width: 50px;">' . $laporan->kategorikode->tentang . '</td><td align="center">' . $laporan->isi_pengaduan . '</td><td align="center" style="width: 100px;">';
            foreach ($laporan->tindaklanjuts as $index => $laptinjut) {
                $html .= $index + 1 . '. ' . $laptinjut->penyebab . '<br></br>';
            }
            $html .= '</td><td align="center" style="width: 150px;">';
            foreach ($laporan->tindaklanjuts as $index => $laptinjut) {
                $html .= $index + 1 . '. ' . $laptinjut->tindakan_korektif . '<br></br>';
            }
            $html .= '</td><td align="center" style="width: 120px;">';
            foreach ($laporan->tindaklanjuts as $index => $laptinjut) {
                $html .= $index + 1 . '. ' . $laptinjut->tinjauan . '<br></br>';
            }
            $html .= '</td><td align="center" style="width: 120px;">';
            foreach ($laporan->tindaklanjuts as $index => $laptinjut) {
                $html .= $index + 1 . '. ' . $laptinjut->kesimpulan . '<br></br>';
            }
            $html .= '</td></tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</body></html>';
        Html::addHtml($section, $html, false, false);
        $section->addText('');
        $html = '<html><body style="font-family: Times New Roman; font-size: 11pt">';
        $html .= '<table style="width:100%;">';
        $html .= '<tr><td align="center" style="width:250px;"></td><td align="center" style="width:70%;"></td><td align="center">Cimahi, ' . date('d F Y') . ' <br></br><br></br><br></br><br></br><br></br> Ipan Ilmansyah Hidayat<br></br>NIP.</td></tr>';
        $html .= '</table>';
        $html .= '</body></html>';
        Html::addHtml($section, $html, false, false);

        $filename = '5.3d Laporan Tinjut BBPPMPV BMTI ' . date('Y') . '.docx';
        $phpWord->save(storage_path('app/' . $filename));

        return response()
            ->download(storage_path('app/' . $filename))
            ->deleteFileAfterSend(true);
    }

    public function LaporanMonev(Request $request)
    {
        $monthTranslations = [
            'January' => 'JANUARI',
            'February' => 'FEBRUARI',
            'March' => 'MARET',
            'April' => 'APRIL',
            'May' => 'MEI',
            'June' => 'JUNI',
            'July' => 'JULI',
            'August' => 'AGUSTUS',
            'September' => 'SEPTEMBER',
            'October' => 'OKTOBER',
            'November' => 'NOVEMBER',
            'December' => 'DESEMBER',
        ];

        $start = Carbon::createFromFormat('Y-m-d', $request->input('start'));
        $end = Carbon::createFromFormat('Y-m-d', $request->input('end'));
        $tentang = $request->input('tentang');

        $laporansStart = Pengaduan::whereDate('tanggal_pengaduan', $start)->where('tentang', $tentang)->get();
        $laporansRange = Pengaduan::whereBetween('tanggal_pengaduan', [$start, $end])
            ->where('tentang', $tentang)
            ->get();
        $laporans = $laporansStart->merge($laporansRange);

        $startMonth = $monthTranslations[$start->format('F')];
        $startYear = $start->format('Y');
        $endMonth = $monthTranslations[$end->format('F')];
        $endYear = $end->format('Y');

        $phpWord = new PhpWord();
        $phpWord->addTitleStyle(0, ['name' => 'Times New Roman', 'bold' => true, 'size' => 12], ['align' => 'center', 'spaceAfter' => 0]);
        $section = $phpWord->addSection();
        $section->addTitle('LAPORAN MONEV PENANGANAN PENGADUAN MASYARAKAT', 0);
        $section->addTitle('BBPPMV BMTI', 0);
        if ($startMonth === $endMonth) {
            $section->addTitle('PERIODE BULAN ' . $startMonth . ' TAHUN ' . $endYear, 0);
        } else {
            $section->addTitle('PERIODE BULAN ' . $startMonth . ' - ' . $endMonth . ' TAHUN ' . $endYear, 0);
        }

        $html = '<html><body style="font-family: Times New Roman; font-size: 11pt">';
        $html .= '<table border="0.8" style="width:100%;">';
        $html .= '<thead>';
        $html .= '<tr><th align="center" style="width: 50px;"><b>Kode</b></th><th align="center"><b>Uraian<br></br>Ketidaksesuaian</b></th><th align="center" style="width: 80px;"><b>Kode Unit</b></th><th align="center" style="width: 100px;"><b>Unit Terkait</b></th><th align="center" style="width: 120px;"><b>Koreksi</b></th><th align="center" style="width: 120px;"><b>Analisis Penyebab</b></th> <th align="center"><b>Tindakan Korektif</b></th></tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach ($laporans as $laporan) {
            $html .= '<tr><td style="width: 50px;">' . $laporan->kategorikode->tentang . '</td><td>' . $laporan->isi_pengaduan . '</td><td style="width: 80px;">';
            foreach ($laporan->pengaduanLinks as $index => $link) {
                $html .= $index + 1 . '. ' . $link->unitkerja->kode_unit . '<br></br>';
            }
            $html .= '</td><td style="width: 100px;">';
            foreach ($laporan->pengaduanLinks as $index => $link) {
                $html .= $index + 1 . '. ' . $link->unitkerja->name . '<br></br>';
            }
            $html .= '</td><td style="width: 120px;">';
            foreach ($laporan->tindaklanjuts as $index => $laptinjut) {
                $html .= $index + 1 . '. ' . $laptinjut->koreksi . '<br></br>';
            }
            $html .= '</td><td style="width: 120px;">';
            foreach ($laporan->tindaklanjuts as $index => $laptinjut) {
                $html .= $index + 1 . '. ' . $laptinjut->penyebab . '<br></br>';
            }
            $html .= '</td><td>';
            foreach ($laporan->tindaklanjuts as $index => $laptinjut) {
                $html .= $index + 1 . '. ' . $laptinjut->tindakan_korektif . '<br></br>';
            }
            $html .= '</td></tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</body></html>';
        Html::addHtml($section, $html, false, false);
        $section->addText('');
        $html = '<html><body style="font-family: Times New Roman; font-size: 11pt">';
        $html .= '<table style="width:100%;">';
        $html .= '<tr><td align="center" style="width:250px;">Kepala ' . auth()->user()->name . '<br></br><br></br><br></br><br></br><br></br>' . auth()->user()->penanggung_jawab . '<br></br>NIP' . auth()->user()->nip . '</td><td align="center" style="width:70%;">Cimahi, ' . date('F Y') . '</td><td align="center">Kepala Bagian Tata Usaha <br></br><br></br><br></br><br></br><br></br> Wanto <br></br> NIP.</td></tr>';
        $html .= '</table>';
        $html .= '</body></html>';
        Html::addHtml($section, $html, false, false);

        $filename = '5.3c Laporan Monev BBPPMPV BMTI ' . date('Y') . '.docx';
        $phpWord->save(storage_path('app/' . $filename));

        return response()
            ->download(storage_path('app/' . $filename))
            ->deleteFileAfterSend(true);
    }

    public function LaporanPengaduanM(Request $request)
    {
        $monthTranslations = [
            'January' => 'JANUARI',
            'February' => 'FEBRUARI',
            'March' => 'MARET',
            'April' => 'APRIL',
            'May' => 'MEI',
            'June' => 'JUNI',
            'July' => 'JULI',
            'August' => 'AGUSTUS',
            'September' => 'SEPTEMBER',
            'October' => 'OKTOBER',
            'November' => 'NOVEMBER',
            'December' => 'DESEMBER',
        ];

        $start = Carbon::createFromFormat('Y-m-d', $request->input('start'));
        $end = Carbon::createFromFormat('Y-m-d', $request->input('end'));

        $laporansStart = Pengaduan::whereDate('tanggal_pengaduan', $start)->get();
        $laporansRange = Pengaduan::whereBetween('tanggal_pengaduan', [$start, $end])->get();
        $laporans = $laporansStart->merge($laporansRange);

        $startMonth = $monthTranslations[$start->format('F')];
        $startYear = $start->format('Y');
        $endMonth = $monthTranslations[$end->format('F')];
        $endYear = $end->format('Y');

        $phpWord = new PhpWord();
        $phpWord->addTitleStyle(0, ['name' => 'Times New Roman', 'bold' => true, 'size' => 14], ['align' => 'center', 'spaceAfter' => 0]);
        $section = $phpWord->addSection();
        $section->addTitle('LAPORAN LAYANAN', 0);
        $section->addTitle('SMKN 1 CIAMIS', 0);
        if ($startMonth === $endMonth) {
            $section->addTitle('PERIODE BULAN ' . $startMonth . ' ' . $endYear, 0);
        } else {
            $section->addTitle('PERIODE BULAN ' . $startMonth . ' - ' . $endMonth . ' TAHUN ' . $endYear, 0);
        }
        $section->addTextBreak();
        $section->addText('Laporan ini merekap semua laporan yang terdata pada website Layanan SMKN 1 Ciamis Mencangkup Pengaduan, Permintaan Informasi, Saran, dan Kerusakan', ['name' => 'Times New Roman', 'size' => 12]);
        // $section->addText('Dengan menyampaikan masalah atau kekurangan yang teridentifikasi, manajemen BBPPMPV BMTI dapat mengambil langkah-langkah yang diperlukan untuk memperbaiki sistem atau prosedur yang ada. Ini dapat meningkatkan efisiensi dan efektivitas kerja, serta memperkuat hubungan antara organisasi dengan stakeholder-nya.  Dengan demikian, pengaduan masyarakat bukan hanya sekadar sarana untuk menyampaikan keluhan atau masalah, tetapi juga merupakan salah satu instrumen yang penting dalam memperkuat tata kelola organisasi dan memastikan bahwa BBPPMPV BMTI beroperasi dengan prinsip-prinsip yang transparan, akuntabel, dan bertanggung jawab.   Berikut adalah rincian laporan pengaduan masyarakat di BBPPMPV BMTI:', ['name' => 'Times New Roman', 'size' => 12]);
        $section->addTextBreak();
        $html = '<html><body style="font-family: Times New Roman; font-size: 11pt">';
        $html .= '<h3><b>Jumlah Tiap Laporan</b></h3>';
        $html .= '<table border="0.8" style="width:70%;">';
        $html .= '<thead>';
        $html .= '<tr><th align="center"><b>Identitas</b></th><th><b><table border="0.8"><tr><td align="center" colspan="4">Kategori Pengaduan</td></tr><tr><td align="center" style="width: 25px;">1</td><td align="center" style="width: 25px;">2</td><td align="center" style="width: 25px;">3</td><td align="center" style="width: 25px;">4</td></tr></table></b></th><th align="center" style="width: 80px;"><b>Total</b></th></tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        $html .=
            '<tr><td>Lengkap</td><td><table border="0.8"><tr><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Lengkap')->where('tentang', 'Pengaduan')->count() .
            '</td><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Lengkap')->where('tentang', 'Kerusakan')->count() .
            '</td><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Lengkap')->where('tentang', 'Permintaan Informasi')->count() .
            '</td><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Lengkap')->where('tentang', 'Saran')->count() .
            '</td></tr></table></td><td style="width: 80px;" align="center">' .
            $laporans->where('identitas_pengaduan', 'Lengkap')->count() .
            '</td></tr>';
        $html .=
            '<tr><td>Siswa</td><td><table border="0.8"><tr><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Siswa')->where('tentang', 'Pengaduan')->count() .
            '</td><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Siswa')->where('tentang', 'Kerusakan')->count() .
            '</td><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Siswa')->where('tentang', 'Permintaan Informasi')->count() .
            '</td><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Siswa')->where('tentang', 'Saran')->count() .
            '</td></tr></table></td><td style="width: 80px;" align="center">' .
            $laporans->where('identitas_pengaduan', 'Siswa')->count() .
            '</td></tr>';
        $html .=
            '<tr><td>Tamu</td><td><table border="0.8"><tr><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Tamu')->where('tentang', 'Pengaduan')->count() .
            '</td><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Tamu')->where('tentang', 'Kerusakan')->count() .
            '</td><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Tamu')->where('tentang', 'Permintaan Informasi')->count() .
            '</td><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Tamu')->where('tentang', 'Saran')->count() .
            '</td></tr></table></td><td style="width: 80px;" align="center">' .
            $laporans->where('identitas_pengaduan', 'Tamu')->count() .
            '</td></tr>';
        $html .=
            '<tr><td>Pengguna Fasilitas</td><td><table border="0.8"><tr><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Pengguna Fasilitas')->where('tentang', 'Pengaduan')->count() .
            '</td><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Pengguna Fasilitas')->where('tentang', 'Kerusakan')->count() .
            '</td><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Pengguna Fasilitas')->where('tentang', 'Permintaan Informasi')->count() .
            '</td><td align="center" style="width:40px;">' .
            $laporans->where('identitas_pengaduan', 'Pengguna Fasilitas')->where('tentang', 'Saran')->count() .
            '</td></tr></table></td><td style="width: 80px;" align="center">' .
            $laporans->where('identitas_pengaduan', 'Pengguna Fasilitas')->count() .
            '</td></tr>';
        $html .=
            '<tr><b><td align="center">Total Per <br></br>Layanan : </td><td><table><tr><td align="center" style="width:40px;">' .
            $laporans->where('tentang', 'Pengaduan')->count() .
            '</td><td align="center" style="width:40px;">' .
            $laporans->where('tentang', 'Kerusakan')->count() .
            '</td><td align="center" style="width:40px;">' .
            $laporans->where('tentang', 'Permintaan Informasi')->count() .
            '</td><td align="center" style="width:40px;">' .
            $laporans->where('tentang', 'Saran')->count() .
            '</td></tr></table></td><td style="width: 80px;" align="center">' .
            $laporans->count() .
            '</td></b></tr>';
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '<h3><b>Keterangan:</b></h3>';
        $html .= '<ol><li>Pengaduan</li>
                    <li>Kerusakan</li>
                    <li>Permintaan Informasi</li>
                    <li>Saran</li>
                    </ol>';
        $html .= '</body></html>';
        Html::addHtml($section, $html, false, false);
        $section->addText('');
        $html = '<html><body style="font-family: Times New Roman; font-size: 11pt">';
        $html .= '<table style="width:100%;">';
        $html .= '<tr><td align="center" style="width:250px;"></td><td align="center" style="width:70%;"></td><td align="center">Ciamis, ' . date('d F Y') . ' <br></br><br></br><br></br><br></br><br></br> Kepala Sekolah</td></tr>';
        $html .= '</table>';
        $html .= '</body></html>';
        Html::addHtml($section, $html, false, false);

        $filename = 'Laporan Layanan SMKN 1 Ciamis ' . date('Y') . '.docx';
        $phpWord->save(storage_path('app/' . $filename));

        return response()
            ->download(storage_path('app/' . $filename))
            ->deleteFileAfterSend(true);
    }
}