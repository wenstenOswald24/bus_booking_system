<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus_seates extends Model
{
    use HasFactory;

    protected $fillable = ['seat_number','price'];
    
    public function bus(){
        return $this->belongsTo('App\Models\Bus');
    }
}
