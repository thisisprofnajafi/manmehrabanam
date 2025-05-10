<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('horoscope_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 12, 0); // Amount in Toman
            $table->string('horoscope_type');
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->boolean('is_winner')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('horoscope_purchases');
    }
}; 