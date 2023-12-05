<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('nip');
            $table->string('nama');
            $table->integer('gaji');
            $table->enum('departemen', ['IT','Human_Resouce','Logistik','Accountant']);
            $table->text('alamat');
            $table->enum('jenis_kelamin',['pria','wanita']);
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
        Schema::dropIfExists('karyawan');
    }
};
