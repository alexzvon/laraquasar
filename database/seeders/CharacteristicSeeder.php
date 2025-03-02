<?php

namespace Database\Seeders;

// use App\Models\GroupСharacteristic;
// use App\Models\NameСharacteristic;
// use App\Models\ValueСharacteristic;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Characteristic;
use Illuminate\Database\Seeder;

class CharacteristicSeeder extends Seeder
{
    // use WithoutModelEvents;

    public $count = 30;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($v = 0; $v < 15; $v++) {
            $group = Characteristic::create([
                'title' => fake()->name(),
                'description' => fake()->text(30),
            ]);

            for ($k = 0; $k < 10; $k++) {
                Characteristic::create([
                    'title' => fake()->title(),
                    'smart' => rand(0, 1),
                    'type' => rand(1, 5),
                    'description' => fake()->text(30),
                ], $group);
            }
        }
    }
}
