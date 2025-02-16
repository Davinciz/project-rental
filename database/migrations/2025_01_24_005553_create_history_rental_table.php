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
        Schema::create('history_rental', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('code');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke tabel users
            $table->foreignId('rental_id')->nullable()->constrained()->OnDelete('set null');
            $table->foreignId('console_id')->nullable()->constrained()->onDelete('set null'); // Relasi ke tabel console
            $table->foreignId('television_id')->nullable()->constrained()->onDelete('set null'); // Relasi ke tabel television
            $table->date('start_date'); // Tanggal mulai rental
            $table->date('end_date'); // Tanggal selesai rental
            $table->bigInteger('total_price'); // Total harga rental
            $table->enum('status', ['disewa', 'dikembalikan', 'dibatalkan'])->default('disewa');
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_rental');
    }
};
