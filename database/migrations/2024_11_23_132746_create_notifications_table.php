<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID pengguna terkait
            $table->string('message'); // Pesan notifikasi
            $table->boolean('is_read')->default(false); // Status notifikasi: sudah dibaca atau belum
            $table->timestamps(); // Waktu dibuat dan diperbarui
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
