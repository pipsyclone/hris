<?php

namespace Database\Seeders;

use App\Models\JobPosition;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Software Engineer',
            ],
            [
                'name' => 'Data Analyst',
            ],
            [
                'name' => 'Project Manager',
            ],
            [
                'name' => 'UX/UI Designer',
            ],
            [
                'name' => 'Quality Assurance Engineer',
            ]
        ];

        foreach ($data as $item) {
            JobPosition::firstOrCreate($item);
        }
    }
}
