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
        if (!Schema::hasTable('formacaos')) {
            Schema::create('formacaos', function (Blueprint $table) {
                $table->bigIncrements('id_formacao');
                $table->foreignId('id_usuario')->constrained('usuarios', 'id_usuario')->onDelete('cascade');
                $table->string('titulacao');
                $table->string('curso_maior_titulacao');
                $table->string('instituicao_maior_titulacao');
                $table->integer('ano_de_conclusao');
                $table->string('lattes');
                $table->date('data_de_inicio_pos')->nullable();
                $table->date('data_de_fim_pos')->nullable();
                $table->string('bolsa_de_pesquisa_concedida')->nullable();
                $table->string('nome_da_bolsa')->nullable();
                $table->string('grupo_de_pesquisa')->nullable();
                $table->string('nome_do_lider')->nullable();
                $table->timestamps(); 
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formacaos');
    }
};