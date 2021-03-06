<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Personal;
use App\Category;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'member_id' => "PLGN200001",
          'name' => "Izzatur Royhan",
          'email' => "royhan@gmail.com",
          'password' => bcrypt("PLGN200001"),
          'api_token' => bcrypt("royhan@gmail.com"),
          'role' => "admin"
        ]);

        Personal::create(['user_id' => "PLGN200001"]);

        Category::create(['name' => 'Workshop']);
        Category::create(['name' => 'Seminar']);

    }
}
