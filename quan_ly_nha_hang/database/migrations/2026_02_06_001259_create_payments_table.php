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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->decimal('so_tien', 12, 2);
            $table->string('phuong_thuc', 50);           // tien_mat, the, momo, vnpay...
            $table->string('trang_thai_thanh_toan', 30)->default('cho_xu_ly');
            $table->string('ma_giao_dich', 100)->nullable();
            $table->timestamp('thoi_gian_thanh_toan')->nullable();
            $table->text('ghi_chu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
