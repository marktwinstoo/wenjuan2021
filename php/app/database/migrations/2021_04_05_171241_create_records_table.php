<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('records', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('email',60);
            $table->string('ip',20);
            $table->tinyInteger('q1')->default(1);
            $table->tinyInteger('q21')->default(0);
            $table->tinyInteger('q22')->default(0);
            $table->tinyInteger('q23')->default(0);
            $table->tinyInteger('q24')->default(0);
            $table->tinyInteger('q25')->default(0);
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
		Schema::drop('records');
	}

}
