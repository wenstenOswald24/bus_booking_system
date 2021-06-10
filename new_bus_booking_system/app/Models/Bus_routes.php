<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus_routes extends Model
{
    use HasFactory;

    protected $fillable = ['bus_id','routes_id','status'];

    public function routes(){
        return $this->belongsTo('App\Models\Routes');
    }

    public function bus(){
        return $this->belongsTo('App\Models\Bus');
    }

    public function bus_schedule(){
        return $this->hasMany('App\Models\Bus_schedules');
    }
}   
