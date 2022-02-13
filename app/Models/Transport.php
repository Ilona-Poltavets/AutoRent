<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $fillable = [
        'model',
        'number',
        'mileage',
        'owner_id',
        'body_type_id',
        'country_id',
    ];
    use HasFactory;
}
