<?php

namespace Database\Seeders;

use App\Models\GroupСharacteristic;
use App\Models\NameСharacteristic;
use App\Models\ValueСharacteristic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        GroupСharacteristic::factory($this->count)->has(
            NameСharacteristic::factory($this->count)->has(
                ValueСharacteristic::factory($this->count)
            )
        )
            ->create();
    }
}
