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
        if(!Schema::hasTable('Instituicao_CO')){
            Schema::create('Instituicao_CO', function (Blueprint $table) {
                $table->bigIncrements('id_contato');
                $table->foreignId('cnpj')->constrained('Instituicao_DB', 'cnpj')->onDelete('cascade');
                $table->string('fone_de_contato'); 
                $table->string('fone_comercial');
                $table->string('ramal');
                $table->string('email');
                $table->string('email_op')->nullable();
                $table->timestamps(); 
            }); 
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Instituicao_CO');
    }
};

