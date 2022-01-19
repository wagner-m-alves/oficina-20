<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Usuário do Admin
        User::create([
            'employee_id'   => 1,
            'name'          => 'Admin',
            'email'         => 'admin@admin.com',
            'password'      => bcrypt('12345678'),
        ]);

        # Usuário do Vendedor de Teste
        User::create([
            'employee_id'   => 2,
            'name'          => 'Harvey Specter',
            'email'         => 'harvey.specter@test.com',
            'password'      => bcrypt('12345678'),
        ]);
    }
}
