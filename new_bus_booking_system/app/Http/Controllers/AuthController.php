<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus_routes;
use App\Models\Bus_schedule_bookings;
use App\Models\Bus_schedules;
use App\Models\Bus_seats;
use App\Models\Bus;
use App\Models\Routes;
use App\Models\Super_admin;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $user = new User();
        $user->create($request->all());
        return "stored successfully";
    } 

    public function login(Request $request){
        $loginData = User::where('name',$request->name)->get('password');
        if($request->password == $loginData[0]->password){
            return "Login Successfull";
        }
        else{
            return "Login Failed";
        }
    }

    public function reset_password(Request $request,$id){
            $user = User::findOrFail($id);
            $user->update($request->all());
            return $user;
    }
}
