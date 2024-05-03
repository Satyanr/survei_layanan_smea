<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanLink extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }

    public function unitkerja()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tindaklanjut()
    {
        return $this->belongsTo(LaporanTindakLanjut::class, 'pengaduan_id');
    }

}