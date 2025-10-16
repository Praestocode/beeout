<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $services = [
            'vegano',
            'vegetariano',
            'tradizionale',
            'street food',
            'internazionale',
            'etnico'
        ];

        foreach ($services as $serviceName) {
            Service::firstOrCreate([
                'name' => $serviceName
            ]);
        }
    }
}
