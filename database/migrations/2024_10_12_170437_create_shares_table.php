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
        Schema::create('shares', function (Blueprint $table) {
            $table->id();
			$table->foreignId('from_user_id')->constrained()->onDelete('cascade')->nullable();
			$table->foreignId('to_user_id')->constrained()->onDelete('cascade')->nullable();
			$table->foreignId('post_id')->nullable();
			$table->enum('status', ['active','inactive'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shares');
    }
};
