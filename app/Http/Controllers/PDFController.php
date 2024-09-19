<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function aduan(Request $request)
    {
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date',
        ]);
        $unit = $request->input('unit');
        $jenis = $request->input('jenis');
        $start = Carbon::createFromFormat('Y-m-d', $request->input('start'));
        $end = Carbon::createFromFormat('Y-m-d', $request->input('end'));
        if ($jenis != null) {
            if ($jenis === 'Belum') {
                if ($unit != null) {
                    if ($start == $end) {
                        $aduan = Pengaduan::whereDate('pengaduans.created_at', $start)->notHaveTindakLanjut()->join('pengaduan_links', 'pengaduan_links.pengaduan_id', '=', 'pengaduans.id')->where('pengaduan_links.user_id', $unit)->get();
                    } else {
                        $aduan = Pengaduan::whereBetween('pengaduans.created_at', [$start, $end])
                            ->notHaveTindakLanjut()
                            ->join('pengaduan_links', 'pengaduan_links.pengaduan_id', '=', 'pengaduans.id')
                            ->where('pengaduan_links.user_id', $unit)
                            ->get();
                    }
                } elseif (auth()->user()->role == 'UnitKerja') {
                    if ($start == $end) {
                        $aduan = Pengaduan::whereDate('pengaduans.created_at', $start)
                            ->notHaveTindakLanjut()
                            ->join('pengaduan_links', 'pengaduan_links.pengaduan_id', '=', 'pengaduans.id')
                            ->where('pengaduan_links.user_id', auth()->user()->id)
                            ->get();
                    } else {
                        $aduan = Pengaduan::whereBetween('pengaduans.created_at', [$start, $end])
                            ->notHaveTindakLanjut()
                            ->join('pengaduan_links', 'pengaduan_links.pengaduan_id', '=', 'pengaduans.id')
                            ->where('pengaduan_links.user_id', auth()->user()->id)
                            ->get();
                    }
                } else {
                    if ($start == $end) {
                        $aduan = Pengaduan::whereDate('created_at', $start)->notHaveTindakLanjut()->get();
                    } else {
                        $aduan = Pengaduan::whereBetween('created_at', [$start, $end])
                            ->notHaveTindakLanjut()
                            ->get();
                    }
                }
            } elseif ($jenis === 'Ditindak') {
                if ($unit != null) {
                    if ($start == $end) {
                        $aduan = Pengaduan::whereDate('pengaduans.created_at', $start)->whereHas('tindaklanjuts')->join('pengaduan_links', 'pengaduan_links.pengaduan_id', '=', 'pengaduans.id')->where('pengaduan_links.user_id', $unit)->get();
                    } else {
                        $aduan = Pengaduan::whereBetween('pengaduans.created_at', [$start, $end])
                            ->whereHas('tindaklanjuts')
                            ->join('pengaduan_links', 'pengaduan_links.pengaduan_id', '=', 'pengaduans.id')
                            ->where('pengaduan_links.user_id', $unit)
                            ->get();
                    }
                } elseif (auth()->user()->role == 'UnitKerja') {
                    if ($start == $end) {
                        $aduan = Pengaduan::whereDate('pengaduans.created_at', $start)
                            ->whereHas('tindaklanjuts')
                            ->join('pengaduan_links', 'pengaduan_links.pengaduan_id', '=', 'pengaduans.id')
                            ->where('pengaduan_links.user_id', auth()->user()->id)
                            ->get();
                    } else {
                        $aduan = Pengaduan::whereBetween('pengaduans.created_at', [$start, $end])
                            ->whereHas('tindaklanjuts')
                            ->join('pengaduan_links', 'pengaduan_links.pengaduan_id', '=', 'pengaduans.id')
                            ->where('pengaduan_links.user_id', auth()->user()->id)
                            ->get();
                    }
                } else {
                    if ($start == $end) {
                        $aduan = Pengaduan::whereDate('created_at', $start)->whereHas('tindaklanjuts')->get();
                    } else {
                        $aduan = Pengaduan::whereBetween('created_at', [$start, $end])
                            ->whereHas('tindaklanjuts')
                            ->get();
                    }
                }
            }
        } else {
            if ($unit != null) {
                if ($start == $end) {
                    $aduan = Pengaduan::whereDate('pengaduans.created_at', $start)->join('pengaduan_links', 'pengaduan_links.pengaduan_id', '=', 'pengaduans.id')->where('pengaduan_links.user_id', $unit)->get();
                } else {
                    $aduan = Pengaduan::whereBetween('pengaduans.created_at', [$start, $end])
                        ->join('pengaduan_links', 'pengaduan_links.pengaduan_id', '=', 'pengaduans.id')
                        ->where('pengaduan_links.user_id', $unit)
                        ->get();
                }
            } elseif (auth()->user()->role == 'UnitKerja') {
                if ($start == $end) {
                    $aduan = Pengaduan::whereDate('pengaduans.created_at', $start)
                        ->join('pengaduan_links', 'pengaduan_links.pengaduan_id', '=', 'pengaduans.id')
                        ->where('pengaduan_links.user_id', auth()->user()->id)
                        ->get();
                } else {
                    $aduan = Pengaduan::whereBetween('pengaduans.created_at', [$start, $end])
                        ->join('pengaduan_links', 'pengaduan_links.pengaduan_id', '=', 'pengaduans.id')
                        ->where('pengaduan_links.user_id', auth()->user()->id)
                        ->get();
                }
            } else {
                if ($start == $end) {
                    $aduan = Pengaduan::whereDate('created_at', $start)->get();
                } else {
                    $aduan = Pengaduan::whereBetween('created_at', [$start, $end])->get();
                }
            }
        }
        $data = [
            'start' => $start->format('d-m-Y'),
            'end' => $end->format('d-m-Y'),
            'jenis' => $jenis,
            'unit' => $unit,
            'pengaduan' => $aduan,
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf.laporan-pdf', $data)->setPaper('a4', 'potrait');

        return $pdf->download('Laporan Pengaduan ' . Carbon::now()->format('d-m-Y') . '.pdf');
    }
}
