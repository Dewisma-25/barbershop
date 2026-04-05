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
        Schema::create('discounts', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->decimal('persen', 5, 2);
    $table->date('tanggal_mulai');
    $table->date('tanggal_selesai');
    $table->boolean('is_active')->default(true);
    $table->integer('created_by')->nullable();
    $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
