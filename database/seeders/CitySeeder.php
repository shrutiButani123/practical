<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gujarat = State::where('name', 'Gujarat')->first();
        $maharastra = State::where('name', 'Maharastra')->first();
        $rajasthan = State::where('name', 'Rajasthan')->first();

        City::create(['name' => 'Surat', 'state_id' => $gujarat->id]);
        City::create(['name' => 'Valsad', 'state_id' => $gujarat->id]);
        City::create(['name' => 'Mumbai', 'state_id' => $maharastra->id]);
        City::create(['name' => 'Nashik', 'state_id' => $maharastra->id]);
        City::create(['name' => 'Ajmer', 'state_id' => $rajasthan->id]);
        City::create(['name' => 'Udaipur', 'state_id' => $rajasthan->id]);
    }
}
