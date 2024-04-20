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
        // For books table
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->uuid('borrowed_by')->nullable();
            $table->uuid('returned_by')->nullable();
            $table->dateTime('borrowed_date')->nullable();
            $table->dateTime('returned_date')->nullable();
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('borrowed_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('returned_by')->references('id')->on('users')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
