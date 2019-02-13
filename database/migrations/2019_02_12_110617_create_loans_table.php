<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('duration');//In Months
            $table->float('loan_amount', 8, 2);
            $table->integer('repayment_frequency');//In Days
            $table->float('interest_rate', 8, 2);
            $table->float('arrangement_fee', 8, 2);
            $table->float('amount_paid', 8, 2)->default(0);//Paid till now
            $table->float('balance_amount', 8, 2)->nullable();//Calculated Later.. so its allowing NULL now
            $table->date('next_payment_date')->nullable();
            $table->float('total_to_be_paid', 8, 2)->nullable();//Calculated Later.. so its allowing NULL now
            $table->integer('status')->default(1);//1 - In Progress
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
        Schema::dropIfExists('loans');
    }
}
