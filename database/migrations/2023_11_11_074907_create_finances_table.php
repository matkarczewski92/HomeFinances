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
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category')->constrained('categories')->nullable()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('group')->constrained('groups')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('saving')->constrained('savings')->nullable()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('type', 2)->comment('i->income, c->cost');
            $table->double('value', 8, 2);
            $table->string('title');
            $table->text('annotations')->nullable();
            $table->integer('payment_day')->nullable();
            $table->date('exp_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
