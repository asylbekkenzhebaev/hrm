<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Department::factory()->count(5)->create();
        $departments = ['Отдел финансов', 'Отдел администрации', 'Отдел ИТ', 'Отдел безопасности'];

        foreach ($departments as $department) {
            \App\Models\Department::factory()->create([
                'name' => $department,
            ]);
        }
    }
}