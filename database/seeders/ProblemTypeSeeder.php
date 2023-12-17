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
        $html = ExamType::where('type', 'HTML')->first();
        $css = ExamType::where('type', 'CSS')->first();
        $javascript = ExamType::where('type', 'Javascript')->first();

        $problemTypes = [
            ['type' => 'HTML Problem 1', 'exam_type_id' => $html->id],
            ['type' => 'CSS Problem 1', 'exam_type_id' => $css->id],
            ['type' => 'Javascript Problem 1', 'exam_type_id' => $javascript->id],
        ];

        ProblemType::insert($problemTypes);
    }
}
