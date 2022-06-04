<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBodyType extends Model
{
    use HasFactory;

    public function transports(){
        return $this->hasMany(Transport::class,'body_type_id','id');
    }
}
