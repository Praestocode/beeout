<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;
use App\Models\Tag;
use App\Models\Service;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $placesData = [
            [
                'name' => 'Caffè Centrale',
                'description' => 'Locale accogliente, ambiente studentesco.',
                'latitude' => 45.464211,
                'longitude' => 9.191383,
                'address' => 'Piazza Centrale, 1',
                'city' => 'Milano',
                'region' => 'Lombardia',
                'tags' => ['student', 'local'],
                'services' => ['tradizionale', 'internazionale']
            ],
            [
                'name' => 'Bistro Chic',
                'description' => 'Locale elegante, perfetto per aperitivi sofisticati.',
                'latitude' => 45.465000,
                'longitude' => 9.190000,
                'address' => 'Via Elegante, 12',
                'city' => 'Milano',
                'region' => 'Lombardia',
                'tags' => ['luxury', 'hype'],
                'services' => ['internazionale', 'vegano']
            ],
        ];

        foreach ($placesData as $pdata) {
            $place = Place::create([
                'name' => $pdata['name'],
                'description' => $pdata['description'] ?? null,
                'latitude' => $pdata['latitude'],
                'longitude' => $pdata['longitude'],
                'address' => $pdata['address'],
                'city' => $pdata['city'],
                'region' => $pdata['region'],
                'pending' => false, // default pending false for seeder
            ]);

            // Links tags
            if (!empty($pdata['tags'])) {
                $tagIds = Tag::whereIn('name', $pdata['tags'])->pluck('id')->toArray();
                $place->tags()->attach($tagIds);
            }

            // Links services
            if (!empty($pdata['services'])) {
                $serviceIds = Service::whereIn('name', $pdata['services'])->pluck('id')->toArray();
                $place->services()->attach($serviceIds);
            }
        }
    }
}
