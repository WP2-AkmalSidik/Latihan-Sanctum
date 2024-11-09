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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menghubungkan ke user
            $table->string('title'); // Judul transaksi
            $table->text('description')->nullable(); // Deskripsi transaksi
            $table->decimal('amount', 15, 2); // Jumlah transaksi
            $table->enum('type', ['income', 'expense']); // Tipe: pemasukan atau pengeluaran
            $table->date('transaction_date'); // Tanggal transaksi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
