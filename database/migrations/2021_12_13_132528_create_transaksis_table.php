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
            ->onDelete('cascade');
            $table->foreignId('petugas_id')->constrained('petugas')
            ->onDelete('cascade');
            $table->foreignId('buku_id')->constrained('bukus')
            ->onDelete('cascade');
            $table->date('tgl_pinjam')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->string('denda')->nullable();
            $table->enum('status',['pinjam','kembali']);
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
