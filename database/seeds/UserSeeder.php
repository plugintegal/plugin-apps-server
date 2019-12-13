<?php

use Illuminate\Database\Seeder;
use App\User;

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
          'password' => bcrypt(12345678),
          'api_token' => bcrypt("royhan@gmail.com"),
          'role' => "admin"
        ]);

        User::create([
          'member_id' => "PLGN190002",
          'name' => "Jamal",
          'email' => "jamal@gmail.com",
          'password' => bcrypt(12345678),
          'api_token' => bcrypt("royhan@gmail.com"),
          'role' => "anggota"
        ]);
    }
}
