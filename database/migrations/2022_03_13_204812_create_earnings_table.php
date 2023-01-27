<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('earnings', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->enum('payment_provider', ['flutterwave', 'mollie', 'midtrans', 'paypal', 'paystack', 'razorpay', 'sslcommerz', 'stripe', 'instamojo', 'offline']);
            $table->foreignId('plan_id')->constrained('plans')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('amount')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('usd_amount')->nullable();
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
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
        Schema::dropIfExists('earnings');
    }
}
