<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kategorikode()
    {
        return $this->belongsTo(Kategori::class, 'kategori', 'nama');
    }

    public function subkategorikode()
    {
        return $this->belongsTo(SubKategori::class, 'subkategori', 'nama');
    }

    public function tindaklanjuts()
    {
        return $this->hasMany(LaporanTindakLanjut::class);
    }

    public function pengaduanLinks()
    {
        return $this->hasMany(PengaduanLink::class, 'pengaduan_id');
    }

    public function scopeNotHaveTindakLanjut($query)
    {
        return $query->whereDoesntHave('tindaklanjuts');
    }
    public function scopeNotHaveLinked($query)
    {
        return $query->whereDoesntHave('pengaduanLinks');
    }
}