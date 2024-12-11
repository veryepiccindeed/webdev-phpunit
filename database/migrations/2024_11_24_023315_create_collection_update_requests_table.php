<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionUpdateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('collection_update_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // who made the request (librarian)
            $table->string('category'); // The category of the item
            $table->unsignedBigInteger('catalogue_id'); // The ID of the catalog item (book, newspaper, etc.)
            $table->string('new_title')->nullable();
            $table->string('new_author')->nullable();
            $table->string('new_publisher')->nullable();
            $table->date('new_datePublished')->nullable();
            $table->decimal('new_price', 8, 2)->nullable();
            $table->integer('new_stock')->nullable();
            $table->string('new_onlineLink')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_update_requests');
    }
};
