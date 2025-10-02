<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceService extends Model
{
    use HasFactory;

    protected $table = 'place_service';

    protected $fillable = [
        'place_id',
        'service_id',
    ];

    public $timestamps = false;

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
