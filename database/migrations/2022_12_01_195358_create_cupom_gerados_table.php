<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCupomGeradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupom_gerados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cupom_id')->constrained('cupons');
            $table->foreignId('client_id')->constrained('clients');
            $table->timestamp('data_resgate')->nullable();
            $table->integer('usado')->default(0);
            $table->timestamp('data_usado')->nullable();

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
        Schema::dropIfExists('cupom_gerados');
    }
}
