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
        if (!Schema::hasTable('enderecos')) {
            Schema::create('enderecos', function (Blueprint $table) {
                $table->bigIncrements('id_endereco');
                $table->foreignId('id_usuario')->constrained('usuarios', 'id_usuario')->onDelete('cascade');
                $table->string('rua');
                $table->string('numero');
                $table->string('complemento')->nullable();
                $table->string('bairro');
                $table->string('cep');
                $table->string('pais');
                $table->string('estado');
                $table->string('municipio');
                $table->timestamps(); 
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};