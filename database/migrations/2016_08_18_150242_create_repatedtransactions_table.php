<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepatedtransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repatedTransactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->enum('type',['expense','income']);
            $table->integer('account_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->double('amount');
            $table->string('label');
            $table->date('startdate');
            $table->enum('rmode',['year','month','week','day']);
            $table->integer('rinterval')->unsigned()->default(1);
            $table->boolean('transfer');
            $table->integer('transfer_account_id')->unsigned()->nullable();
            $table->timestamps();
        });

        if(Schema::hasTable('repatedTransactions') && Schema::hasTable('accounts')) {
            Schema::table('repatedTransactions', function (Blueprint $table) {
                $table->foreign('account_id')
                    ->references('id')
                    ->on('accounts')
                    ->onDelete('cascade');
            });
        }

        if(Schema::hasTable('repatedTransactions') && Schema::hasTable('users')) {
            Schema::table('repatedTransactions', function (Blueprint $table) {
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            });
        }

        if(Schema::hasTable('repatedTransactions') && Schema::hasTable('categories')) {
            Schema::table('repatedTransactions', function (Blueprint $table) {
                $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
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
        Schema::drop('repatedTransactions');
    }
}
