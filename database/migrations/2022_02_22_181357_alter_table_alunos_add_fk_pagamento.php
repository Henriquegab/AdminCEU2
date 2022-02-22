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
    public function up()
    {
        Schema::table('alunos', function (Blueprint $table) {
            
            $table->unsignedBigInteger('pagamento_id')->nullable();
            
        });


        Schema::table('alunos', function (Blueprint $table) {
            
            $table->foreign('pagamento_id')->references('id')->on('pagamentos');
            
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alunos', function (Blueprint $table) {
            
            
            
            $table->dropForeign('alunos_pagamento_id_foreign');

        });

        Schema::table('alunos', function (Blueprint $table) {
            
            $table->dropColumn('pagamento_id');
            
        });
    }
};
