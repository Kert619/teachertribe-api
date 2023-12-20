<?php

namespace Database\Seeders;

use App\Models\ExamType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $examTypes = [
            ['exam_type' => 'HTML'],
            ['exam_type' => 'CSS'],
            ['exam_type' => 'Javascript'],
        ];

        ExamType::insert($examTypes);
    }
}
