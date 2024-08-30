<?php

namespace Database\Seeders;

use App\Models\Projects;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Projects::insert([
            [
                'name' => 'AAM Aero'
            ],
            [
                'name' => 'Pinter CO UK'
            ],
            [
                'name' => 'Digital Biaterek'
            ],
            [
                'name' => 'Fuel Post',
            ],
            [
                'name' => 'Fuel Monitoring System'
            ]
        ]);
    }
}
