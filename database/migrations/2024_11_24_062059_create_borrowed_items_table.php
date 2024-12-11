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
        Schema::create('borrowed_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('borrower_id');  // Who made the request (librarian or student)
            $table->unsignedBigInteger('borrowable_id');  // The ID of the borrowed item (e.g., book, journal)
            $table->string('borrowable_type');  // The type of the borrowed item (e.g., Book, Journal, etc.)
            $table->date('borrowed_at');  // The date when the item was borrowed
            $table->date('due_date');  // The date when the item is due for return
            $table->timestamps();  // Timestamps for created_at and updated_at

            // Foreign key to the users table
            $table->foreign('borrower_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowed_items');
    }
};
