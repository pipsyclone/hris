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
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'phone' => '0987654321',
                'resume' => 'path/to/resume.pdf',
                'position' => 2,
                'status' => 'interviewed',
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alicejohnson@example.com',
                'phone' => '1122334455',
                'resume' => 'path/to/resume.pdf',
                'position' => 3,
                'status' => 'hired',
            ],
            [
                'name' => 'Bob Brown',
                'email' => 'bobbrown@example.com',
                'phone' => '5566778899',
                'resume' => 'path/to/resume.pdf',
                'position' => 4,
                'status' => 'rejected',
            ],
        ];

        JobCandidate::insert($data);
    }
}
