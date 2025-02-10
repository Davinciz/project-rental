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
        Schema::table('history_rental', function (Blueprint $table) {
            $table->dropForeign(['rental_id']); // Hapus constraint lama
            $table->foreign('rental_id')
                  ->references('id')
                  ->on('rentals')
                  ->onDelete('set null'); // Set NULL saat rental dihapus
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('history_rental', function (Blueprint $table) {
            $table->dropForeign(['rental_id']);
            $table->foreign('rental_id')
                  ->references('id')
                  ->on('rentals')
                  ->onDelete('restrict'); // Kembalikan ke behavior awal
        });
    }
};
