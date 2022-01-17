<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Admin
        Employee::create([
            'name' => 'Admin'
        ]);

        # Vendedor de Teste
        Employee::create([
            'name' => 'Harvey Specter'
        ]);
    }
}
