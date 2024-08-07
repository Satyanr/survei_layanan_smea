<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PengaduanExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExportController extends Controller
{
    public function exportpengaduan(Request $request)
    {
        return Excel::download(new PengaduanExport($request), 'pengaduan.xlsx');
    }
}
