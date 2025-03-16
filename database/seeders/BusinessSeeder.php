<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSeeder extends Seeder
{
    public function run(): void
    {
        $business = [
            'name' => 'YellowTech',
            'phone' => '+96170285659',
            'address' => 'Lebanon, Beirut, Dora',
            'email' => 'yellow.tech.953@gmail.com',
            'website' => 'https://yellowtech.dev',
            'logo' => 'assets/images/logo.png',
            'tax_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $model = Business::create($business);

        $operating_hours = [
            ['business_id' => $model->id, 'day' => 'Monday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '06:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['business_id' => $model->id, 'day' => 'Tuesday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '06:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['business_id' => $model->id, 'day' => 'Wednesday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '06:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['business_id' => $model->id, 'day' => 'Thursday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '06:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['business_id' => $model->id, 'day' => 'Friday', 'open' => true, 'opening_hour' => '08:00 AM', 'closing_hour' => '06:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['business_id' => $model->id, 'day' => 'Saturday', 'open' => false, 'opening_hour' => null, 'closing_hour' => null, 'created_at' => now(), 'updated_at' => now()],
            ['business_id' => $model->id, 'day' => 'Sunday', 'open' => false, 'opening_hour' => null, 'closing_hour' => null, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('operating_hours')->insert($operating_hours);
    }
}
