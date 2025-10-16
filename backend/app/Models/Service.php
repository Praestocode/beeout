<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name'];

    public function places()
    {
        return $this->belongsToMany(Place::class, 'place_service');
    }
}
