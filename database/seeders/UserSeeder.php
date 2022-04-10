<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Henrique Gabriel Siqueira da Cruz',
                'email' => 'henriquepro8@gmail.com',
                'password' => '$2y$10$eoabik5xE3790Niw15WpreE3PMCE1eQFt9ZyZnAUZ7FBWPWlnJ/Le',
            ]);
    }
}
