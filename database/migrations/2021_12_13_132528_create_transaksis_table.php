<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')
            ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('petugas_id')->nullable();
            $table->foreignId('buku_id')->constrained('bukus')
            ->cascadeOnDelete()->cascadeOnUpdate();
            $table->smallInteger('hari')->nullable();
            $table->date('tgl_pinjam')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->date('tgl_pengembalian')->nullable();
            $table->integer('denda')->nullable();
            $table->enum('status',['pinjam','menunggu verifikasi','kembali']);
            $table->enum('status_denda',['lunas','belum lunas']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
