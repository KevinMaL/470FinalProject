<?php
use Illuminate\Database\Seeder;
use App\User;
use App\Profile;

class UserSeeder extends Seeder {

    public function run() {

        //create admin for me
        User::create( [
            'email' => 'admin@sfu.ca' ,
            'password' => Hash::make( 'asdf23' ) ,
            'name' => 'admin' ,
            'is_admin' => 1,
        ] );

        $faker = app(Faker\Generator::class);
        //generate 100 users for testing
        for ($i = 1; $i <= 100; $i++) {
          $email = $faker->unique()->safeEmail();
          $pieces = explode("@", $email);
          $name = $pieces[0];
          User::create( [
            'email' => $email,
            'password' => Hash::make( 'asdf23' ) ,
            'name' => $name,
          ] );

          $profile = new Profile();
          $profile->user_id = $i;
          $profile->bio = $faker->sentence($nbWords = 15, $variableNbWords = true);
          $profile->avatar = $faker->imageUrl(400, 400, 'cats');
          $profile->save();
        }

        User::create( [
            'email' => 'noadmin@sfu.ca' ,
            'password' => Hash::make( 'asdf23' ) ,
            'name' => 'noadmin' ,
            'is_admin' => 0,
        ] );
    }
}
