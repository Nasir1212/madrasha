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
            // Personal Info
            $table->biginteger('uid')->unique()->nullable();
            $table->string('first_name_bn')->nullable();
            $table->string('last_name_bn')->nullable();
            $table->string('first_name_en')->nullable();
            $table->string('last_name_en')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('gender')->nullable();
            $table->string('religion')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_reg_no')->nullable();
            $table->string('photo')->nullable();


            // Parents Info
            $table->string('father_name_bn')->nullable();
            $table->string('mother_name_bn')->nullable();
            $table->string('father_name_en')->nullable();
            $table->string('mother_name_en')->nullable();
            $table->string('parents_contact')->nullable();


            // Address Info
            $table->text('full_address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('police_station')->nullable();
            $table->string('nationality')->default('Bangladeshi');


          
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
