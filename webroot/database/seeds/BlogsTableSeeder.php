<?php

use Illuminate\Database\Seeder;
use App\Blog;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);
        for($i = 0; $i < 200; $i++){
            $created = $faker->dateTimeThisMonth();
            $updated = $faker->dateTimeBetween($created,'now');
            Blog::create( [
                'title' => $faker->text($maxNbChars = 30),
                'content' => $faker->realText(1600,2),
                'user_id' => $faker->numberBetween($min = 1, $max = 100),
                'created_at' => $created,
                'updated_at' => $updated,
            ]);
        }


    }
}

