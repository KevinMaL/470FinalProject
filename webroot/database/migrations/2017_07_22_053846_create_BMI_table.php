<?php


use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;


class CreateBMITable extends Migration

{

	/**

	* Run the migrations.

	*

	* @return void

	*/

	public function up()

	{
		Schema::create('bmis', function (Blueprint $table) {
            		$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->decimal('weight');
			$table->decimal('height');
			$table->decimal('bmicalculate');
			$table->string('classification');
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

		Schema::dropIfExists('bmis');

	}

}
