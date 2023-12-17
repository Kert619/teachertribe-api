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
            ['type' => 'HTML'],
            ['type' => 'CSS'],
            ['type' => 'Javascript'],
        ];

        ExamType::insert($examTypes);
    }
}
