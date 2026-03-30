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
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId("receiver_wallet_id")
                    ->nullable()
                    ->constrained("wallets")
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId("receiver_wallet_id")
                    ->nullable()
                    ->constrained("wallets")
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
        });
    }
};
