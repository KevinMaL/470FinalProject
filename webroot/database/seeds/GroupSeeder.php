<?php
use Illuminate\Database\Seeder;
use App\User;
use App\Group;
use App\GroupMember;

class GroupSeeder extends Seeder {

    public function run() {

        //assuming the user seed is already run
        $faker = app(Faker\Generator::class);
        $users = User::all();
        //generate 10 groups for testing
        for ($i = 1; $i <= 10; $i++) {
          Group::create( [
            'name' => 'test_group_'.$i ,
            'description' => $faker->realText(30,1),
            'owner_id' => $i/3 + 1,
          ] );
        }

        foreach($users as $user){
            for($i = 1; $i <= 10; $i++){
            //each user randomly joins some groups
                if(rand(0,1) == 1){
                    GroupMember::create( [
                        'group_id' => $i ,
                        'user_id' => $user->id,
                    ]);
                }
            }

        }


        $groups = Group::all();
        foreach($groups as $group){
            for($i = 1; $i <= 2; $i++){
                if(rand(0,1) == 1){
                    $group->assignAdmin($faker->numberBetween(1,100));
                }
            }
        }


    }
}
