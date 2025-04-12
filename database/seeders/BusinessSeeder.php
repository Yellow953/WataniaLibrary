<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    public function run(): void
    {
        $business = [
            'name' => 'Watania Library',
            'phone' => '+96176925969',
            'address' => 'Lebanon, Beirut, Dora',
            'email' => 'yellow.tech.953@gmail.com',
            'tax_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        Business::create($business);
    }
}
