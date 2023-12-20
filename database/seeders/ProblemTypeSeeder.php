<?php

namespace Database\Seeders;

use App\Models\ExamType;
use App\Models\ProblemType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProblemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $html = ExamType::where('exam_type', 'HTML')->first();
        $css = ExamType::where('exam_type', 'CSS')->first();
        $javascript = ExamType::where('exam_type', 'Javascript')->first();

        $problemTypes = [
            ['problem_type' => 'HTML Problem 1', 'exam_type_id' => $html->id],
            ['problem_type' => 'CSS Problem 1', 'exam_type_id' => $css->id],
            ['problem_type' => 'Javascript Problem 1', 'exam_type_id' => $javascript->id],
        ];

        ProblemType::insert($problemTypes);
    }
}
