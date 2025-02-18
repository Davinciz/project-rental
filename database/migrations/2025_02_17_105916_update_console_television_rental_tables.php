<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Hapus kolom image dan description di tabel console
        Schema::table('consoles', function (Blueprint $table) {
            $table->dropColumn(['image', 'description']);
        });

        // Hapus kolom image dan description di tabel television
        Schema::table('televisions', function (Blueprint $table) {
            $table->dropColumn(['image']);
        });

        // Tambahkan enum baru "returned" pada status rental
        Schema::table('rentals', function (Blueprint $table) {
            $table->enum('status', ['pending', 'accepted', 'canceled', 'returned'])->default('pending')->change();
        });
    }

    public function down(): void
    {
        // Tambahkan kembali kolom image dan description jika rollback
        Schema::table('consoles', function (Blueprint $table) {
            $table->string('image')->nullable();
            $table->text('description')->nullable();
        });

        Schema::table('televisions', function (Blueprint $table) {
            $table->string('image')->nullable();
            $table->text('description')->nullable();
        });

        // Kembalikan status tanpa "returned"
        Schema::table('rentals', function (Blueprint $table) {
            $table->enum('status', ['pending', 'accepted', 'canceled'])->default('pending')->change();
        });
    }
};
