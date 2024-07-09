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
            $table->uuid('id_user');
            $table->string('no_complaint');
            $table->date('complaint_date');
            $table->enum('complaint_title', ['network', 'kode qr', 'referance number', 'letter line', 'understand use aplication']);
            $table->text('desciption_complaint');
            $table->enum('status_complaint', ['completed', 'not completed']);
            $table->string('image_complaint')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
