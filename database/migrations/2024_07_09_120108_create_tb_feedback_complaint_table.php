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
        Schema::create('tb_feedback_complaint', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_complaint');
            $table->text('desciption_feedback');
            $table->string('image_feedback')->nullable();
            $table->foreign('id_complaint')->references('id')->on('tb_complaint')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_feedback_complaint');
    }
};
