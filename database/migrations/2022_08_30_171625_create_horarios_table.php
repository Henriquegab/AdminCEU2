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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aluno_id');
            // $table->unsignedBigInteger('modalidade_id');
            $table->string('dia');
            $table->time('entrada');
            $table->time('saida');

            $table->timestamps();
        });

        Schema::table('horarios', function (Blueprint $table) {

            $table->foreign('aluno_id')->references('id')->on('alunos');
            // $table->foreign('modalidade_id')->references('id')->on('modalidades');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('horarios', function (Blueprint $table) {



            $table->dropForeign('horarios_aluno_id_foreign');
            // $table->dropForeign('horarios_modalidade_id_foreign');

        });

        Schema::table('horarios', function (Blueprint $table) {

            // $table->dropColumn('modalidade_id');
            $table->dropColumn('aluno_id');

        });

        Schema::dropIfExists('horarios');
    }
};
