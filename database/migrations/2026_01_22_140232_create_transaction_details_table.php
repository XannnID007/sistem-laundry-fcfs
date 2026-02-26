<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id('detail_id');
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('linen_id');
            $table->integer('qty');
            $table->timestamps();

            // Foreign keys (transactions dan linens HARUS sudah ada)
            $table->foreign('transaction_id')->references('transaction_id')->on('transactions')->onDelete('cascade');
            $table->foreign('linen_id')->references('linen_id')->on('linens')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
