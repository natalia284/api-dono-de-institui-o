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
        if (!Schema::hasTable('contatos')) {
            Schema::create('contatos', function (Blueprint $table) {
                $table->bigIncrements('id_contato');
                $table->foreignId('id_usuario')->constrained('usuarios', 'id_usuario')->onDelete('cascade');
                $table->string('email');
                $table->string('email_sec')->nullable();
                $table->string('telefone_fixo')->nullable();
                $table->string('celular');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contatos');
    }
};