<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('acc_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('account_lists')->cascadeOnDelete()->cascadeOnUpdate();
            $table->double('value', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acc_balances');
    }
};
