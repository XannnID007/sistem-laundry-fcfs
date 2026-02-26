<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('tgl_transaksi');
            $table->enum('status', ['Pending', 'Dijemput', 'Proses', 'Selesai', 'Diantar'])->default('Pending');
            $table->integer('total_qty');
            $table->timestamps();

            // Foreign key ke users (users HARUS sudah ada)
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            // Index untuk optimasi query FCFS (ORDER BY tgl_transaksi ASC)
            $table->index('tgl_transaksi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
