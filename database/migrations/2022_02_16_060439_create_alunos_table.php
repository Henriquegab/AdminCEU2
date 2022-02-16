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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->string('cpf', 14)->unique();
            $table->date('nascimento');
            $table->string('pai', 50)->nullable();
            $table->string('mae', 50)->nullable();
            $table->string('endereco', 50);
            $table->string('telefone', 30)->nullable();
            $table->string('categoria', 30);
            $table->string('modalidade', 30)->nullable();
            $table->date('data');
            $table->string('professor', 30);
            $table->string('turno', 30);
            $table->string('horario', 30);
            $table->string('dias', 30);
            $table->string('nome_medico', 50);
            $table->date('data_atestado');


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
        Schema::dropIfExists('alunos');
    }
};
