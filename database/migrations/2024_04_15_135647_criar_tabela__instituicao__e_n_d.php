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
        if (!Schema::hasTable('Instituicao_END')) {
            Schema::create('Instituicao_END', function (Blueprint $table) {
                $table->bigIncrements('id_endereco');
                $table->foreignId('cnpj')->constrained('Instituicao_DB', 'cnpj')->onDelete('cascade');
                $table->string('cep'); 
                $table->string('pais');
                $table->string('estado');
                $table->string('cidade');
                $table->string('bairro');
                $table->string('logradouro');
                $table->string('numero');
                $table->string('complemento')->nullable();
                $table->timestamps(); 
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Instituicao_END');
    }
};