<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); // Kolom ID (primary key)
            $table->string('image'); // Kolom untuk menyimpan path gambar
            $table->string('title'); // Kolom judul project
            $table->text('description'); // Kolom deskripsi project
            $table->timestamp('tanggalpembuatan')->nullable(); // Kolom tanggal pembuatan
            $table->timestamps(); // Kolom untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
