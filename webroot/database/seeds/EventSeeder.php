<?php
use Illuminate\Database\Seeder;
use App\User;
use App\Event;
use App\UserEvent;

class EventSeeder extends Seeder {

    public function run() {
        $faker = app(Faker\Generator::class);



        for ($i = 1; $i <= 100; $i++) {

                $created = $faker->dateTimeThisMonth();
                $updated = $faker->dateTimeBetween($created,'now');
                $event_start = $faker->dateTimeBetween('- 60 days', '+ 60 days');
                $event_end = $faker->dateTimeInInterval($event_start, '+ 2 days');

                $event = Event::create( [
                    'title' => $faker->text($maxNbChars = 30),
                    'address' => $faker->address(),
                    'event_description' => $faker->realText(200,2),
                    'event_start' => $event_start,
                    'event_end' => $event_end,
                    'group_id' => $faker->numberBetween(1,10),
                    'is_fullday' => $faker->boolean(10),
                    'created_at' => $created,
                    'updated_at' => $updated,
                ] );
                for($j = 1; $j <= 20; $j++){
                    UserEvent::create([
                        'user_id' => $faker->numberBetween(1,100),
                        'event_id' => $event->id,
                    ]);
                }

        }
    }
}
