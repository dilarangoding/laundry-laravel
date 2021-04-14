<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('outlet_id')->nullable();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('user_id');
            $table->string('invoice');
            $table->string('date')->nullable();
            $table->string('expired')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('additional_cost')->nullable();
            $table->string('discount')->nullable();
            $table->string('tax')->nullable();
            $table->enum('status',['baru','proses','selesai','diambil']);
            $table->enum('paid',['dibayar','belum dibayar']);
            $table->string('total')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
