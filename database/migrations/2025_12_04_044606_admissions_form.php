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
         Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            // 1. Student Info
            $table->string('form_no')->nullable()->unique();
            $table->string('name_bn_first')->nullable();
            $table->string('name_bn_last')->nullable();
            $table->string('name_en_first')->nullable();
            $table->string('name_en_last')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_reg_no')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('student_photo')->nullable();

            // 2. Father Info
            $table->string('father_bn')->nullable();
            $table->string('father_en')->nullable();
            $table->string('father_nid')->nullable();
            $table->string('father_birth_reg')->nullable();
            $table->date('father_birth_date')->nullable();

            // Mother Info
            $table->string('mother_bn')->nullable();
            $table->string('mother_en')->nullable();
            $table->string('mother_nid')->nullable();
            $table->string('mother_birth_reg')->nullable();
            $table->date('mother_birth_date')->nullable();

            // Guardian Info
            $table->string('guardian_name')->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->string('guardian_phone')->nullable();

            // Permanent Address
            $table->string('perm_village')->nullable();
            $table->string('perm_post')->nullable();
            $table->string('perm_union')->nullable();
            $table->string('perm_upazila')->nullable();
            $table->string('perm_district')->nullable();

            // Current Address
            $table->string('curr_village')->nullable();
            $table->string('curr_post')->nullable();
            $table->string('curr_union')->nullable();
            $table->string('curr_upazila')->nullable();
            $table->string('curr_district')->nullable();

            // Admission Related
            $table->string('admit_class')->nullable();
            $table->string('previous_class')->nullable();
            $table->string('previous_institute')->nullable();
            $table->string('leave_certificate_no')->nullable();
            $table->date('leave_certificate_date')->nullable();

            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
