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
            $table->string('ordercode');
            $table->string('user_id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->text('cartlist');
            $table->integer('total');
            $table->string('payment_method')->default('Thanh toán khi nhận hàng');
            $table->text('note')->default(null);
            $table->string('status')->default('pending'); //pending,waiting,success,cancel
            $table->string('is_processed')->default('done'); //pending,waiting,success,cancel
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
