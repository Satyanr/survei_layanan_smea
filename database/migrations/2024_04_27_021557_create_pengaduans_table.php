<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengaduan')->nullable();
            $table->string('identitas_pengaduan')->nullable();
            $table->string('nama_pengadu')->nullable();
            $table->string('alamat_pengadu')->nullable();
            $table->string('no_telp_pengadu')->nullable();
            $table->string('email_pengadu')->nullable();
            $table->string('tempat')->nullable();
            $table->string('tentang')->nullable();
            $table->text('isi_pengaduan')->nullable();
            // $table->string('jenis_layanan')->nullable();
            // $table->string('type')->nullable();
            $table->string('kategori')->nullable();
            $table->string('sub_kategori')->nullable();
            $table->string('kode_kategori')->nullable();
            $table->string('bukti_foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};