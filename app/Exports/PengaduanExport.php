<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PengaduanExport implements FromView
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $this->request->validate([
            'start' => 'required|date',
            'end' => 'required|date',
        ],
        [
            'start.required' => 'Tanggal awal harus di isi',
            'end.required' => 'Tanggal akhir harus di isi',
        ]);
        $unit = $this->request->input('unit');
        $jenis = $this->request->input('jenis');
        $start = Carbon::createFromFormat('Y-m-d', $this->request->input('start'));
        $end = Carbon::createFromFormat('Y-m-d', $this->request->input('end'));
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

        return view('excel.laporan-excel', [
            'start' => $start->format('d-m-Y'),
            'end' => $end->format('d-m-Y'),
            'pengaduan' => $aduan,
        ]);
    }
}
