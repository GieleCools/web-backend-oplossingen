<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			   	$table->increments('id');
		        $table->string('email')->unique();
		        $table->string('password'); 	//min 60 karakters nodig voor db field van paswd, anders werkt laravel authenticatie niet
		        $table->rememberToken();		//remember token moet in db aanwezig zijn om te kunnen authenticeren --> w gebruikt voor "remember me" sessies
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
		Schema::drop('users');
	}

}
