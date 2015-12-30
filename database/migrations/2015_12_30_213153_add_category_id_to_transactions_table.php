<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('transactions') && Schema::hasTable('categories')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->integer('category_id')->unsigned()->afer('account_id');
            });

            Schema::table('transactions', function (Blueprint $table) {
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
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('transactions_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }
}
