<?php

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
            $table->increments('id');
            $table->string('label');
            $table->double('amount');
            $table->enum('type',['expense','income']);
            $table->integer('account_id')->unsigned();
            $table->timestamps();
        });

        if(Schema::hasTable('transactions') && Schema::hasTable('accounts')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->foreign('account_id')
                    ->references('id')
                    ->on('accounts')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
}
