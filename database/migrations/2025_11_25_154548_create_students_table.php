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
         Schema::create('students', function (Blueprint $table) {
            $table->id();

            // =====================
            // Student Information
            // =====================
            $table->string('uid')->nullable();
            $table->string('name_bn_first')->nullable();
            $table->string('name_bn_last')->nullable();
            $table->string('name_en_first')->nullable();
            $table->string('name_en_last')->nullable();

            $table->date('birth_date')->nullable();
            $table->string('birth_reg_no')->nullable();
            $table->enum('gender', ['male', 'female','others']);
            $table->string('nationality', 50)->nullable();
            $table->string('blood_group', 5)->nullable();
            $table->string('religion', 20)->nullable();
            $table->string('student_photo')->nullable();

            // =====================
            // Father Information
            // =====================
            $table->string('father_bn')->nullable();
            $table->string('father_en')->nullable();
            $table->string('father_nid', 30)->nullable();
            $table->string('father_birth_reg', 30)->nullable();
            $table->date('father_birth_date')->nullable();

            // =====================
            // Mother Information
            // =====================
            $table->string('mother_bn')->nullable();
            $table->string('mother_en')->nullable();
            $table->string('mother_nid', 30)->nullable();
            $table->string('mother_birth_reg', 30)->nullable();
            $table->date('mother_birth_date')->nullable();

            // =====================
            // Guardian Information
            // =====================
            $table->string('guardian_name')->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->string('guardian_phone', 20)->nullable();

            // =====================
            // Permanent Address
            // =====================
            $table->string('perm_village')->nullable();
            $table->string('perm_post')->nullable();
            $table->string('perm_union')->nullable();
            $table->string('perm_upazila')->nullable();
            $table->string('perm_district')->nullable();

            // =====================
            // Current Address
            // =====================
            $table->string('curr_village')->nullable();
            $table->string('curr_post')->nullable();
            $table->string('curr_union')->nullable();
            $table->string('curr_upazila')->nullable();
            $table->string('curr_district')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
