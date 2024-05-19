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
        $unit = $request->input('unit');
        $start = Carbon::createFromFormat('Y-m-d', $request->input('start'));
        $end = Carbon::createFromFormat('Y-m-d', $request->input('end'));
        if ($unit != null) {
            if ($start == $end) {
                $aduan = Pengaduan::whereDate('pengaduans.created_at', $start)->join('pengaduan_links', 'pengaduan_links.pengaduan_id', '=', 'pengaduans.id')->where('pengaduan_links.user_id', $unit)->get();
            } else {
                $aduan = Pengaduan::whereBetween('pengaduans.created_at', [$start, $end])
                    ->join('pengaduan_links', 'pengaduan_links.pengaduan_id', '=', 'pengaduans.id')
                    ->where('pengaduan_links.user_id', $unit)
                    ->get();
            }
        } else {
            if ($start == $end) {
                $aduan = Pengaduan::whereDate('created_at', $start)->get();
            } else {
                $aduan = Pengaduan::whereBetween('created_at', [$start, $end])->get();
            }
        }
        $data = [
            'pengaduan' => $aduan,
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf.laporan-pdf', $data)->setPaper('a4', 'potrait');

        return $pdf->stream();
    }
}
