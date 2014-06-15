<?php

use Illuminate\Database\Migrations\Migration;

class CreatePesapalpaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("pesapalpayments",function($table){
            $table->increments("id");
            $table->text("tracking_id");
            $table->text("payment_method");
            $table->longtext("description");
            $table->string("currency");
            $table->string("user");
            $table->string("first_name");
            $table->string("last_name");
            $table->string("email");
            $table->string("phone_number");
            $table->integer("amount");
            $table->string("reference");
            $table->string("type");
            $table->integer("enabled");
            $table->string("status");
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
		Schema::drop("pesapalpayments");
	}

}