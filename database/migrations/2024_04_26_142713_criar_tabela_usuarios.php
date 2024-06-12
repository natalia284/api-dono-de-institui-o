<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasTable('usuarios')){
            Schema::create('usuarios', function (Blueprint $table) {
                $table->bigIncrements('id_usuario');
                $table->string('nome');
                $table->date('data_de_nascimento');
                $table->string('sexo'); 
                $table->string('estado_civil')->nullable();
                $table->string('nacionalidade'); 
                $table->string('naturalidade');
                $table->string('cpf')->nullable();
                $table->string('passaporte')->nullable();
                $table->string('nome_do_pai')->nullable();
                $table->string('nome_da_mae');
                $table->timestamps(); 
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
