<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus_routes;
use App\Models\Bus_schedule_bookings;
use App\Models\Bus_schedules;
use App\Models\Bus_seates;
use App\Models\Bus;
use App\Models\Routes;
use App\Models\Super_admin;
use App\Models\User;

class UserController extends Controller
{
    public function bus_schedule_list($role){
        if($role == "user"){
            $bus_schedules = Bus_schedules::latest()->get();
            return $bus_schedules;
        }
    }

    public function users($role){
        if($role == "user"){
            $users = User::latest()->get();
            return $users;
        }
    }

    public function book_schedule(Request $request, $role){
        if($role == "user"){
            $bus_schedules = Bus_schedules::where('id', $request->bus_schedule_id)->get();
            $users = User::where('id',$request->user_id)->get(); 
            $bus_seats = Bus_seates::where('id',$request->bus_seats_id)->get();
            $seat_availability = Bus_schedule_bookings::where('seat_number',$request->seat_number)->get();
            $is_schedule_valid = false;
            $is_user_valid = false;
            $is_bus_seats_valid = false;
            
            error_log($bus_schedules);
            error_log(count($users) );
            if(count($bus_schedules) > 0) { $is_schedule_valid = true;}
            if(count($users) > 0) { $is_user_valid = true;}
            if(count($bus_seats) > 0) {$is_bus_seats_valid = true;}
            if(count($seat_availability) > 0){return "seat already booked";}
            if($is_user_valid == true && $is_schedule_valid == true && $is_bus_seats_valid){
                $bookings = new Bus_schedule_bookings();
                $bookings->create($request->all());
            return "Successfully saved";
            } else {
                return "User ID or Bus-Schedule-ID is Invalid";
            }
        } else {
            return "User Type Invalid";
        }
    }

    public function my_bookings($role, $id){ 
            $user = Bus_schedule_bookings::where('user_id', $id)->get();       
            if($role == "user" && count($user) > 0){
                return $user;
            } else {
                return "Entered Id is not available";
            }

        }

    public function cancel_bookings(Request $request){
        date_default_timezone_set('Asia/Colombo');
        $current_time = date("Y-m-d H:i:s");

        $created_at =  Bus_schedule_bookings::where(['user_id'=>$request->user_id,'id'=>$request->id])->get('created_at')[0]->created_at;
        $time_hours = (strtotime($current_time) - strtotime($created_at)) / 3600;

        if($time_hours < 10){
        Bus_schedule_bookings::where(['user_id'=>$request->user_id,'id'=>$request->id])
        ->update(['status' => 'CANCELLED']);
        } else {
            return "Cannot cancel the booking, since the allocated time limit has exceeded";
        }
    }
}