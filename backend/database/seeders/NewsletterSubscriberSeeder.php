<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsletterSubscriber;

class NewsletterSubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Popolazione statica con gli ultimi due utenti dal seeder User
        $subscribers = [
            [
                'name' => 'Giulia',
                'email' => 'giuliafabrizi@gmail.com',
                'confirmed' => true,
            ],
            [
                'name' => 'Antonio',
                'email' => 'antonioesposito@gmail.com',
                'confirmed' => true,
            ],
        ];

        foreach ($subscribers as $s) {
            NewsletterSubscriber::create($s);
        }
    }
}
