<?php


use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;


class CreateCaloriesTable extends Migration

{
    
	/**
     
	* Run the migrations.
     
	*
     * @return void
     
	*/
    public function up()
    
	{
		Schema::create('calories', function (Blueprint $table) {
            		$table->increments('id');
			$table->integer('user_id');
			$table->decimal('weight');
			$table->decimal('caloriecalculate');
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

		Schema::dropIfExists('calories');
	}

}
