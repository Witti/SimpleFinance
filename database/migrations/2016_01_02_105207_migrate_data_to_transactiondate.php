<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateDataToTransactiondate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $transactions = \DB::table('transactions')->get();

        foreach($transactions as $t) {
            if($t->transactiondate == '0000-00-00') {
                \DB::table('transactions')
                    ->where('id',$t->id)
                    ->update(['transactiondate' => date('Y-m-d',strtotime($t->created_at))]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
