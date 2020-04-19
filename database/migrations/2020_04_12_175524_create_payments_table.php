<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 5,2);
            $table->decimal('igst', 5,2);
            $table->decimal('cgst', 5,2);
            $table->decimal('sgst', 5,2);
            $table->decimal('net_amount', 5,2);
            $table->date('last_date');
            $table->string('order_id');
            $table->string('receipent_id');
            $table->dateTime('payment_date');
            $table->tinyInteger('payment_status')->default('0');
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
        Schema::dropIfExists('payments');
    }
}
