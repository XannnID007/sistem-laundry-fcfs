<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->enum('role', ['Manajer', 'Hotel', 'Laundry']);
            $table->unsignedBigInteger('hotel_id')->nullable();
            $table->timestamps();

            // Foreign key ke hotels (hotels HARUS sudah ada)
            $table->foreign('hotel_id')->references('hotel_id')->on('hotels')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
