<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = ['name','type','vehicle_number'];

    public function bus_seates(){
        return $this->hasMany('App\Models\Bus_seates');
    }

    public function bus_routes(){
        return $this->hasMany('App\Models\Bus_routes');
    }
}
