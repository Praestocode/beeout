<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name', 'description', 'latitude', 'longitude', 'address', 'city', 'region', 'pending'
    ];

    // Relazione molti-a-molti con Tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'place_tag');
    }

    // Relazione molti-a-molti con Service
    public function services()
    {
        return $this->belongsToMany(Service::class, 'place_service');
    }

    // Relazione uno-a-molti con immagini
    // public function images()
    // {
    //     return $this->hasMany(PlaceImage::class);
    // }
}
