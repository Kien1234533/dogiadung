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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('slug');
            $table->text('shortdesc');
            $table->longText('description');
            $table->integer('price');
            $table->integer('pricesale')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('quantity');
            $table->integer('sold')->default(0);
            $table->text('image');
            $table->char('status', 10);
            $table->char('outstand', 10)->default('close');
            $table->integer('comment_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
