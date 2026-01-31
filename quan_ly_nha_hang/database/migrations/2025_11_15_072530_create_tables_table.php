<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('number');                    // A1, OUT1, VIP1...
            $table->integer('seats');
            $table->string('zone');                      // indoor, outdoor, sushi_bar
            $table->decimal('pos_x', 8, 2);              // vị trí ngang (%)
            $table->decimal('pos_y', 8, 2);              // vị trí dọc (%)
            $table->enum('status', ['available', 'booked'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};