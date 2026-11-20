<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code', 40)->unique();
            $table->string('customer_name', 100);
            $table->string('customer_phone', 25);
            $table->string('customer_email', 100);
            $table->text('shipping_address');
            $table->string('payment_method', 50);
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->string('status', 30)->default('pending'); // pending, processing, shipped, completed, cancelled
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
