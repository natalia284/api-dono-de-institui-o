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
        if (!Schema::hasTable('Instituicao_DB')) {
            Schema::create('Instituicao_DB', function (Blueprint $table) {
                $table->string('nome'); 
                $table->date('data_de_fundacao'); 
                $table->string('cnpj')->primary();
                $table->string('cpf_do_reitor');
                $table->timestamps(); 
            }); 
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Instituicao_DB');
    }
};