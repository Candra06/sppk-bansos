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
        Schema::create('himpunan_fuzzy', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('variabel_id')->unsigned();
            $table->string('himpunan');
            $table->foreign('variabel_id')->references('id')->on('variabel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('himpunan_fuzzy');
    }
};
