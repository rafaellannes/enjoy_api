<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoteirosServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roteiros_servicos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('roteiro_id')->constrained('roteiros');
            $table->foreignId('servico_id')->constrained('servicos');
            $table->integer('ordem')->default(0);


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
        Schema::dropIfExists('roteiros_servicos');
    }
}
