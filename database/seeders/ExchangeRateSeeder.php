<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExchangeRate;

class ExchangeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedData('2023-12-15', '169');
        $this->seedData('2023-12-14', '150');
    }

    private function seedData($date, $rate)
    {
        ExchangeRate::create([
            'date' => $date,
            'rate' => $rate,
        ]);
    }
}
