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
            'categoria' => 'Acadêmico - 1 dia',
            'preco' => '15'
        ]);
        Categoria::create(
        [
            'categoria' => 'Acadêmico - 2 dias',
            'preco' => '30'
        ]);
        Categoria::create(
        [
            'categoria' => 'Acadêmico - 3 dias',
            'preco' => '40'
        ]);
        Categoria::create(
        [
            'categoria' => 'Acadêmico - 4 dias',
            'preco' => '50'
        ]);
        Categoria::create(
        [
            'categoria' => 'Acadêmico - 5 dias',
            'preco' => '60'
        ]);
        Categoria::create(
        [
            'categoria' => 'Servidor - 1 dia',
            'preco' => '15'
        ]);
        Categoria::create(
        [
            'categoria' => 'Servidor - 2 dias',
            'preco' => '30'
        ]);
        Categoria::create(
        [
            'categoria' => 'Servidor - 3 dias',
            'preco' => '40'
        ]);
        Categoria::create(
        [
            'categoria' => 'Servidor - 4 dias',
            'preco' => '50'
        ]);
        Categoria::create(
        [
            'categoria' => 'Servidor - 5 dias',
            'preco' => '60'
        ]);
        Categoria::create(
        [
            'categoria' => 'Professor - 1 dia',
            'preco' => '18'
        ]);
        Categoria::create(
        [
            'categoria' => 'Professor - 2 dias',
            'preco' => '35'
        ]);
        Categoria::create(
        [
            'categoria' => 'Professor - 3 dias',
            'preco' => '50'
        ]);
        Categoria::create(
        [
            'categoria' => 'Professor - 4 dias',
            'preco' => '60'
        ]);
        Categoria::create(
        [
            'categoria' => 'Professor - 5 dias',
            'preco' => '70'
        ]);
        Categoria::create(
        [
            'categoria' => 'Comunidade - 1 dia',
            'preco' => '20'
        ]);
        Categoria::create(
        [
            'categoria' => 'Comunidade - 2 dias',
            'preco' => '40'
        ]);
        Categoria::create(
        [
            'categoria' => 'Comunidade - 3 dias',
            'preco' => '60'
        ]);
        Categoria::create(
        [
            'categoria' => 'Comunidade - 4 dias',
            'preco' => '70'
        ]);
        Categoria::create(
        [
            'categoria' => 'Comunidade - 5 dias',
            'preco' => '80'
        ]);
    
    }
}