<?php

namespace Database\Seeders;

use App\Models\ExamSetting;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Student::factory(10)->create();

        ExamSetting::updateOrCreate([], [
            'passing_score' => 50,
            'exam_time_limit' => 60,
            'status' => true,
            'grading_system' => json_encode([
                'A' => 90,
                'B' => 80,
                'C' => 70,
                'D' => 60,
                'E' => 50,
                'F' => 0,
            ]),
        ]);
    }
}
