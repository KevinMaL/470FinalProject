<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->call(UserSeeder::class);
       $this->call(GroupSeeder::class);
       $this->call(BlogsTableSeeder::class);
       $this->call(FollowersTableSeeder::class);
       $this->call(MessageSeeder::class);
       $this->call(EventSeeder::class);
       $this->call(PostSeeder::class);
    }
}
