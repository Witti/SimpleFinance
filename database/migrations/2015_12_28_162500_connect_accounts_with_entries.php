<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectAccountsWithEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('entries') && Schema::hasTable('accounts')) {
            Schema::table('entries', function (Blueprint $table) {
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
        //
    }
}
