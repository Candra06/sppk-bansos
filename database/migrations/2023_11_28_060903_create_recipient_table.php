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
        Schema::create('recipient', function (Blueprint $table) {
            $table->increments('id');
            $table->String('nama');
            $table->string('nik');
            $table->enum('gender',['Laki-laki','Perempuan']);
            $table->text('address');
            $table->double('bobot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipient');
    }
};
