<?php
use Illuminate\Database\Seeder;
use App\User;
use App\Post;
use App\Group;

class PostSeeder extends Seeder {

    public function run() {
        $faker = app(Faker\Generator::class);


        $groups = Group::all();
        foreach($groups as $group){
            for ($i = 1; $i <= 25; $i++) {

                $created = $faker->dateTimeThisMonth();
                $updated = $faker->dateTimeBetween($created,'now');
                $receiver_id = $faker->numberBetween(1, 100);
                while($receiver_id == $i){
                    $receiver_id = $faker->numberBetween(1, 100);
                }
                $post = Post::create( [
                    'user_id' => $faker->numberBetween(1, 100),
                    'parent_id' => 0,
                    'group_id' => $group->id,
                    'post_body' => $faker->realText(),
                    'created_at' => $created,
                    'updated_at' => $updated,
                ] );
                $post->root_id = $post->id;
                $post->save();

            }
        }

        for ($i = 1; $i <= 1000; $i++) {
            $post_count = Post::count();
            $user_count = User::count();
            $post_id = $faker->numberBetween($post_count/2,$post_count);
            $user_id = $faker->numberBetween(1,$user_count);
            Post::newReply($post_id,$faker->realText(),$user_id);
        }


    }
}
