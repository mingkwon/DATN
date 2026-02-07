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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('ten_khach', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->foreignId('table_id')->constrained('tables')->onDelete('restrict');
            $table->foreignId('book_id')->nullable()->constrained('books')->onDelete('set null');
            $table->string('order_type', 30)->default('walk_in'); // dat_truoc | di_lai
            $table->string('trang_thai', 30)->default('open');
            $table->decimal('tong_tien_truoc_giam', 12, 2)->default(0);
            $table->decimal('giam_gia', 12, 2)->default(0);
            $table->decimal('thue', 12, 2)->default(0);
            $table->decimal('tong_thanh_toan', 12, 2)->default(0);
            $table->text('ghi_chu_don')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
