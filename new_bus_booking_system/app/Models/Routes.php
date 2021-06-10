<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    use HasFactory;

    protected $fillable = ['node_one','node_two','route_number','distance','time']; 

    public function Bus_routes(){
        return $this->hasMany('App\Model\Bus_routes');
    }

}
