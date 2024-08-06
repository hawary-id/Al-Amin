<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('umur');
            $table->text('alamat');
            $table->integer('durasi_asuransi')->nullable();
            $table->date('tanggal_mulai_asuransi')->nullable();
            $table->date('tanggal_selesai_asuransi')->nullable();
            $table->enum('status_peserta',['pending','diterima','tolak'])->default('pending');
            $table->enum('status_dokumen',['pending','diterima','tolak'])->default('pending');
            $table->timestamp('approved_peserta_at')->nullable();
            $table->timestamp('approved_dokumen_at')->nullable();
            $table->uuid('created_by');
            $table->uuid('updated_by');
            $table->uuid('deleted_by')->nullable();
            $table->uuid('approved_peserta_by')->nullable();
            $table->uuid('approved_dokumen_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta');
    }
}
