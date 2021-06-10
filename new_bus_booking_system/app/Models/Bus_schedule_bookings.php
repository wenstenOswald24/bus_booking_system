<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus_schedule_bookings extends Model
{
    use HasFactory;

    // 'bus_seats_id','user_id','bus_schedule_id',
    protected $fillable = ['bus_seats_id','user_id','bus_schedule_id','seat_number','price','status'];

    public function bus_seats(){
        return $this->belongsTo('App\Models\Bus_seats');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function bus_schedule(){
        return $this->belongsTo('App\Models\Bus_schedules');
    }
}
