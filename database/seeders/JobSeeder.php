<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Job::create([
            'name' => 'Frontend Web Programmer',
        ]);
        Job::create([
            'name' => 'FullStack Web Programmer',
        ]);
        Job::create([
            'name' => 'Quality Control',
        ]);
    }
}
