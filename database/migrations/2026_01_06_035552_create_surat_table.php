<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id('id_surat');

            $table->string('nomor_surat')->nullable();
            $table->date('tanggal_surat')->nullable();

            $table->unsignedBigInteger('id_dudi');
            $table->unsignedBigInteger('id_jurusan')->nullable();

            $table->string('tingkat')->nullable();

            $table->enum('status', ['draft', 'edited', 'downloaded'])
                ->default('draft');

            $table->uuid('session_key')->nullable();

            $table->timestamps();

            $table->foreign('id_dudi')
                ->references('id_dudi')
                ->on('dudi')
                ->onDelete('restrict');

            $table->foreign('id_jurusan')
                ->references('id_jurusan')
                ->on('jurusan')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
