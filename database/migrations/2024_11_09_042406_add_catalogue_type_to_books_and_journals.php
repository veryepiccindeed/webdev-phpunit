<?php

// database/migrations/xxxx_xx_xx_add_catalogue_type_to_books_and_journals.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCatalogueTypeToBooksAndJournals extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('catalogue_type')->default('book');
        });

        Schema::table('journals', function (Blueprint $table) {
            $table->string('catalogue_type')->default('journal');
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('catalogue_type');
        });

        Schema::table('journals', function (Blueprint $table) {
            $table->dropColumn('catalogue_type');
        });
    }
};
