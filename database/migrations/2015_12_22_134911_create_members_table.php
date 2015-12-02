<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first');
			$table->string('last');
			$table->string('identification');
			$table->string('mobile')->nullable();
			$table->string('home')->nullable();
			$table->string('address')->nullable();
			$table->string('district')->nullable();
			$table->date('birthdate');
			$table->boolean('active');
			$table->text('note')->nullable();
			$table->string('avatar')->nullable();
			$table->string('school_name')->nullable();
			$table->date('baptized')->nullable();
			$table->integer('rev_baptized')->nullable();
			$table->integer('church_baptized')->nullable();
			$table->integer('last_rev')->nullable();
			$table->integer('last_church')->nullable();
			$table->enum('civil_status',['Unmarried','Married','Free_union','Divorced']);
			$table->string('email')->nullable();
			$table->enum('labor_status',['Employed','Unemployed','Independent']);
			$table->string('profession')->nullable();
			$table->enum('educational_level',['Primary','Secundary','Technical','Technologist','University']);
			$table->integer('group')->unsigned()->nullable();
			$table->foreign('group')->references('id')->on('groups');
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
		Schema::drop('members');
	}

}
