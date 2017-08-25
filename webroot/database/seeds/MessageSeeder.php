<?php
use Illuminate\Database\Seeder;
use App\User;
use App\Message;

class MessageSeeder extends Seeder {

    public function run() {
        $faker = app(Faker\Generator::class);



        //generate 1000 messages for testing
        for ($i = 1; $i <= 100; $i++) {
            for($j = 1; $j <= 100; $j++){
                $created = $faker->dateTimeThisMonth();
                $updated = $faker->dateTimeBetween($created,'now');
                $receiver_id = $faker->numberBetween(1, 100);
                while($receiver_id == $i){
                    $receiver_id = $faker->numberBetween(1, 100);
                }
                Message::create( [
                    'sender_id' => $i,
                    'receiver_id' => $receiver_id,
                    'has_read' => $faker->boolean(),
                    'message_body' => $faker->realText(),
                    'owner_id' => $i,
                    'created_at' => $created,
                    'updated_at' => $updated,
                ] );
                Message::create( [
                    'sender_id' => $i,
                    'receiver_id' => $receiver_id,
                    'has_read' => $faker->boolean(),
                    'message_body' => $faker->realText(),
                    'owner_id' => $receiver_id,
                    'created_at' => $created,
                    'updated_at' => $updated,
                ] );
            }

        }
    }
}
