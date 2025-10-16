<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name', 'description', 'latitude', 'longitude', 'address', 'city', 'region', 'pending'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'place_tag');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'place_service');
    }
}
