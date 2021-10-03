<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\User;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(Faker $faker)
  {
    for ($i = 0; $i <= 10; $i++) {
      User::create([
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('password'),
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
      ]);
    }
  }
}
