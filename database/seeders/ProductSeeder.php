<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(Faker $faker)
  {
    for ($i = 0; $i <= 50; $i++) {
      Product::create([
        'name' => $faker->text(50),
        'slug' => $faker->slug,
        'description' => $faker->text,
        'price' => $faker->randomFloat(null, 0.99, 999999999.99),
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
      ]);
    }
  }
}
