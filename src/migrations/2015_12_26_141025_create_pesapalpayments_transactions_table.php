<?php
use Illuminate\Database\Migrations\Migration;
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 12/26/15
 * Time: 4:49 PM
 */
class CreatePesapalpaymentsTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("pesapal_payments_transactions",function($table){
            $table->increments("id");
            $table->text("tracking_id");
            $table->string("reference");
            $table->string("status");
            $table->longText("data");
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
        Schema::drop("pesapal_payments_transactions");
    }

}