<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('amount');
            $table->bigInteger('credit_ledger_id')->unsigned();
            $table->foreign('credit_ledger_id')
				  ->references('id')
				  ->on('ledgers');
            $table->bigInteger('debit_ledger_id')->unsigned();
            $table->foreign('debit_ledger_id')
				  ->references('id')
				  ->on('ledgers');
            $table->timestamps();
            $table->softDeletes();
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
