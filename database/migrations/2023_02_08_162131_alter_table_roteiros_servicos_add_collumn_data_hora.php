<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableRoteirosServicosAddCollumnDataHora extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roteiros_servicos', function (Blueprint $table) {
            $table->dateTime('data_hora')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roteiros_servicos', function (Blueprint $table) {
            $table->dropColumn('data_hora');
        });
    }
}
