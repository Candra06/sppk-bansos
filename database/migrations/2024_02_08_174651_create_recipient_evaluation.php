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
        Schema::create('recipient_evaluation', function (Blueprint $table) {
            $table->id();
            $table->integer('recipient_id')->unsigned();
            $table->integer('variabel_id')->unsigned();
            $table->integer('himpunan_id')->unsigned();
            $table->double('bobot');
            $table->foreign('recipient_id')->references('id')->on('recipient');
            $table->foreign('variabel_id')->references('id')->on('variabel');
            $table->foreign('himpunan_id')->references('id')->on('himpunan_fuzzy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipient_evaluation');
    }
};
