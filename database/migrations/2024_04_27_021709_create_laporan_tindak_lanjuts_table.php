<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_tindak_lanjuts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->constrained('pengaduans');
            $table->foreignId('user_id')->constrained('users');
            $table->text('penyebab')->nullable();
            $table->text('koreksi')->nullable();
            $table->text('tindakan_korektif')->nullable();
            $table->text('tinjauan')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->string('bukti_foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_tindak_lanjuts');
    }
};