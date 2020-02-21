<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Personal;

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
          'member_id' => "PLGN190001",
          'name' => "Izzatur Royhan",
          'email' => "royhan@gmail.com",
          'password' => bcrypt("PLGN190001"),
          'api_token' => bcrypt("royhan@gmail.com"),
          'role' => "admin"
        ]);

        Personal::create(['user_id' => "PLGN190001"]);
    }
}
