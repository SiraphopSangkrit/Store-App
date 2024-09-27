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
        Schema::create('product', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('product_name');
            $table->integer('product_qty');
                $table->string('product_color');
                $table->double('product_price');
                $table->string('product_image')->nullable();
                $table->bigInteger('create_by_user')->unsigned()->nullable();
                $table->foreign('create_by_user')->references('id')->on('users')->onDelete('cascade');
                $table->bigInteger('category_id')->unsigned()->nullable();
                $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
