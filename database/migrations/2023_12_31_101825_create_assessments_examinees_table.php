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
        Schema::create('assessment_examinees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained();
            $table->foreignId('examinee_id')->constrained();
            $table->string('pin');
            $table->string('test_mode');
            $table->foreignId('group_id')->nullable()->constrained();
            $table->dateTime('schedule_from');
            $table->dateTime('schedule_to');
            $table->string('started_on')->nullable();
            $table->string('finished_on')->nullable();
            $table->string('marks')->nullable();
            $table->string('status')->default('Pending');
            $table->integer('retry_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments_examinees');
    }
};
