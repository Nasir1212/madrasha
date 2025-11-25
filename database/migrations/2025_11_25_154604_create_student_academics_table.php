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
        Schema::create('student_academics', function (Blueprint $table) {
            $table->id();
              // Academic Info
               $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('class')->nullable();
            $table->integer('roll')->nullable();
            $table->string('session')->nullable();
            $table->enum('status',['active','promoted','graduated'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_academics');
    }
};
