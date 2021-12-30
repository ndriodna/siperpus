<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')
            ->onDelete('cascade');;
            $table->integer("nim")->nullable();
            $table->string("nama")->nullable();
            $table->enum("jk",['L','P'])->nullable();
            $table->string("jurusan")->nullable();
            $table->string("telp")->nullable();
            $table->string("alamat")->nullable();
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
        Schema::dropIfExists('members');
    }
}
