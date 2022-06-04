<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    public function rents(){
        return $this->belongsToMany(Rent::class);
    }
    public function transports(){
        return $this->hasMany(Transport::class,'owner_id','id');
    }
}
