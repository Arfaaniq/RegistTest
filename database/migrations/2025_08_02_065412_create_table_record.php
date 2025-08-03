<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produk_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('action'); // 'created', 'updated', 'deleted'
            $table->json('old_values')->nullable(); // nilai sebelum diubah
            $table->json('new_values')->nullable(); // nilai setelah diubah
            $table->text('changes_description'); // deskripsi perubahan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produk_histories');
    }
};