<?php

namespace Database\Seeders;

use App\Models\JobCandidate;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobCandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'phone' => '1234567890',
                'resume' => 'path/to/resume.pdf',
                'position' => 1,
                'status' => 'pending',
            ]
        ];

        JobCandidate::insert($data);
    }
}
