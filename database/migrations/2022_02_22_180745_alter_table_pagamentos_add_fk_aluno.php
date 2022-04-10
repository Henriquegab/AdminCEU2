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
        Schema::table('pagamentos', function (Blueprint $table) {
            
            $table->unsignedBigInteger('aluno_id');
            
        });


        Schema::table('pagamentos', function (Blueprint $table) {
            
            $table->foreign('aluno_id')->references('id')->on('alunos');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagamentos', function (Blueprint $table) {
            
            
            
            $table->dropForeign('pagamentos_aluno_id_foreign');

        });

        Schema::table('pagamentos', function (Blueprint $table) {
            
            $table->dropColumn('aluno_id');
            
        });


    }
};
