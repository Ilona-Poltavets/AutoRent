<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'id_tenant', 'id');
    }

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
