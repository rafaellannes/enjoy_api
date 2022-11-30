<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClientsTableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->boolean('notificacao')->default(false);
            $table->boolean('descontos')->default(false);
            $table->enum('sexo', ['M', 'F', 'O'])->nullable();
            $table->date('data_nascimento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('notificacao');
            $table->dropColumn('descontos');
            $table->dropColumn('sexo');
            $table->dropColumn('data_nascimento');
        });
    }
}
