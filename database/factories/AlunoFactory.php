<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Aluno;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aluno>
 */
class AlunoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Aluno::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'cpf' => $this->faker->numerify('###.###.###-##'),
            'nascimento' => $this->faker->dateTime(),
            'endereco' => $this->faker->streetName,
            'numero' => $this->faker->numberBetween(1,1000),
            'telefone' => $this->faker->numerify('(##) ########'),
            'modalidade' => 'Natação',
            'inicio' => '18:40:00',
            'termino' => '19:20:00',
            'segunda' => 'on',
            'data_atestado' => $this->faker->dateTime(),
            'categoria_id' => $this->faker->numberBetween(1,10),
            
        ];
    }
}
