<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ServiceSeeder::class,
            TagSeeder::class,
            PlaceSeeder::class,
            UserSeeder::class,
            NewsletterSubscriberSeeder::class,
        ]);
    }
}
?>