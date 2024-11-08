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
        Schema::create('tb_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->text('location')->nullable();
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();;
            $table->date('end_date')->nullable();
            $table->json('images')->nullable(); 
            $table->string('video')->nullable();
            $table->integer('customer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_projects');
    }
};
