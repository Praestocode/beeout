<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tags = [
            'student',
            'business',
            'luxury',
            'hype',
            'local',
            'underground'
        ];

        foreach ($tags as $tagName) {
            Tag::firstOrCreate([
                'name' => $tagName
            ]);
        }
    }
}
