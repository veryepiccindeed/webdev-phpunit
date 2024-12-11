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
        Schema::create('c_d_s', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->text('description');
            $table->bigInteger('price')->default(0);
            $table->integer('stock')->default(0);
            $table->date('datePublished');
            $table->enum('genre', ['fiction', 'nonfiction', 'fantasy', 'mystery', 'science_fiction', 'biography']);
            $table->text('onlineLink');
            $table->string('catalogue_type')->default('CD');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_d_s');
    }
};
