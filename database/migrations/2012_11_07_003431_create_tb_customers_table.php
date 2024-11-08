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
        Schema::create('tb_customers', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('company_name');
            $table->string('address');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('contact_person');
            $table->string('commercial_record')->nullable();
            $table->string('tax_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_customers');
    }
};
