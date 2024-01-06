<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assessment_examinees_problems', function (Blueprint $table) {
            $table->foreignId('assessment_examinee_id')->constrained();
            $table->foreignId('problem_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
            $table->primary(['assessment_examinee_id', 'problem_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('assessment_examinees_problems');
    }
};
