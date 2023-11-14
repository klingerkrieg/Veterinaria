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
        Schema::create('vacinacoes', function (Blueprint $table) {
            $table->id();
            $table->date("data");
            $table->date("validade");
            $table->foreignId("pet_id")->references('id')->on('pets');
            $table->foreignId("vacina_id")->references('id')->on('vacinas');
            $table->foreignId("veterinario_id")->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacinacoes');
    }
};
