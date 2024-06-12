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
        if (!Schema::hasTable('profissaos')) {
            Schema::create('profissaos', function (Blueprint $table) {
                $table->bigIncrements('id_profissao');
                $table->foreignId('id_usuario')->constrained('usuarios', 'id_usuario')->onDelete('cascade');
                $table->string('vinculo');
                $table->string('instituicao')->nullable();
                $table->string('situacao_funcional')->nullable();
                $table->string('cargo')->nullable();
                $table->string('campus')->nullable();
                $table->string('centro')->nullable();
                $table->string('departamento')->nullable();
                $table->string('logradouro');
                $table->string('numero');
                $table->string('complemento')->nullable();
                $table->string('bairro');
                $table->string('cep');
                $table->string('pais');
                $table->string('estado');
                $table->string('municipio');
                $table->string('fone_com');
                $table->string('ramal')->nullable();
                $table->string('preferencia_envio')->nullable();
                $table->timestamps(); 
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profissaos');
    }
};
