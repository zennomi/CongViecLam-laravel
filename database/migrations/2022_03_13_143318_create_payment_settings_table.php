<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('paypal')->default(true);
            $table->boolean('paypal_live_mode')->default(false);
            $table->boolean('stripe')->default(true);
            $table->boolean('razorpay')->default(true);
            $table->boolean('paystack')->default(true);
            $table->boolean('ssl_commerz')->default(true);
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
        Schema::dropIfExists('payment_settings');
    }
}
