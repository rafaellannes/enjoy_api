<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAcessoServicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acesso_servicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servico_id')->constrained('servicos');
            $table->foreignId('cliente_id')->constrained('clients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_acesso_servicos');
    }
}
