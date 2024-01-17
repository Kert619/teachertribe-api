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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string("fullname");
            $table->enum("gender", ['Male', "Female"]);
            $table->integer("age");
            $table->string("school");
            $table->string("course");
            $table->string("year_level");
            $table->string("email");
            $table->string("contact");
            $table->text("q1");
            $table->text("q2");
            $table->text("q3");
            $table->text("q4");
            $table->text("q5");
            $table->text("q6");
            $table->text("q7");
            $table->boolean("q8");
            $table->text("q9");
            $table->text("q10");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
