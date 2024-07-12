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
        Schema::create('tb_complaint', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_user')->constrained('users');
            $table->string('no_complaint');
            $table->foreignUuid('id_category_complaint')->constrained('tb_category_complaint');
            $table->text('description_complaint');
            $table->enum('status_complaint', ['reviewed', 'not reviewed']);
            $table->string('image_complaint')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_complaint');
    }
};
