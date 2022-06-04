<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    public function country(){
        return $this->hasOne(Country::class, 'country_id','id');
    }
    public function carBodyType(){
        return $this->belongsTo(CarBodyType::class, 'id','body_type_id');
    }
    public function owner(){
        return $this->belongsTo(Owner::class, 'id','owner_id');
    }
    public function rents(){
        return $this->hasMany(Rent::class,'id_transport');
    }
}
