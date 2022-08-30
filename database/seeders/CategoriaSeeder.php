<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create(
        [
            'categoria' => 'Acadêmico - 1 aula',
            'preco' => '15'
        ]);
        Categoria::create(
        [
            'categoria' => 'Acadêmico - 2 aulas',
            'preco' => '30'
        ]);
        Categoria::create(
        [
            'categoria' => 'Acadêmico - 3 aulas',
            'preco' => '40'
        ]);
        Categoria::create(
        [
            'categoria' => 'Acadêmico - 4 aulas',
            'preco' => '50'
        ]);
        Categoria::create(
        [
            'categoria' => 'Acadêmico - 5 aulas',
            'preco' => '60'
        ]);
        Categoria::create(
        [
            'categoria' => 'Servidor - 1 aula',
            'preco' => '15'
        ]);
        Categoria::create(
        [
            'categoria' => 'Servidor - 2 aulas',
            'preco' => '30'
        ]);
        Categoria::create(
        [
            'categoria' => 'Servidor - 3 aulas',
            'preco' => '40'
        ]);
        Categoria::create(
        [
            'categoria' => 'Servidor - 4 aulas',
            'preco' => '50'
        ]);
        Categoria::create(
        [
            'categoria' => 'Servidor - 5 aulas',
            'preco' => '60'
        ]);
        Categoria::create(
        [
            'categoria' => 'Professor - 1 aula',
            'preco' => '18'
        ]);
        Categoria::create(
        [
            'categoria' => 'Professor - 2 aulas',
            'preco' => '35'
        ]);
        Categoria::create(
        [
            'categoria' => 'Professor - 3 aulas',
            'preco' => '50'
        ]);
        Categoria::create(
        [
            'categoria' => 'Professor - 4 aulas',
            'preco' => '60'
        ]);
        Categoria::create(
        [
            'categoria' => 'Professor - 5 aulas',
            'preco' => '70'
        ]);
        Categoria::create(
        [
            'categoria' => 'Comunidade - 1 aula',
            'preco' => '20'
        ]);
        Categoria::create(
        [
            'categoria' => 'Comunidade - 2 aulas',
            'preco' => '40'
        ]);
        Categoria::create(
        [
            'categoria' => 'Comunidade - 3 aulas',
            'preco' => '60'
        ]);
        Categoria::create(
        [
            'categoria' => 'Comunidade - 4 aulas',
            'preco' => '70'
        ]);
        Categoria::create(
        [
            'categoria' => 'Comunidade - 5 aulas',
            'preco' => '80'
        ]);
        Categoria::create(
        [
            'categoria' => 'Aluno - Hidroginástica',
            'preco' => '30'
        ]);
        Categoria::create(
        [
            'categoria' => 'Comunidade - Hidroginástica',
            'preco' => '40'
        ]);

    }
}
