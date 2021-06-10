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

class SuperAdminController extends Controller
{

    public function bus_management(Request $request, $role, $type){
        if($role == "super_admin" && $type == "add"){
            //$bus = new Bus();
            Bus::create($request->all());
        } else if($role == "super_admin" && $type == "edit"){
            $bus = Bus::findOrFail($id);
            $bus->update($request->all());
            return $bus;
        }
    }

    public function route_management(Request $request, $role, $type){
        if($role == "super_admin" && $type == "add"){
            $route = new Routes();
            $route->create($request->all());
        } else if($role == "super_admin" && $type == "edit"){
            $route = Routes::findOrFail($id);
            $route->update($request->all());
            return $route;
        }
    }

    public function route_bus_mapping(Request $request, $role, $type){
            $bus = Bus::where('id',$request->bus_id)->get();
            $route = Routes::where('id',$request->routes_id)->get();
            
            if(count($bus) > 0){  $is_bus_valid = true;}
            if(count($route) > 0){  $is_route_valid = true;}
            if($is_bus_valid == true && $is_route_valid == true){
                if($role == "super_admin" && $type == "add"){
                    $bus_route = new Bus_routes();
                    $bus_route->create($request->all());
                    return "successfully stored";

            } else if($role == "super_admin" && $type == "edit"){
                    $bus_route = Bus_routes::findOrFail($id);
                    $bus_route->update($request->all());
                    return $bus_route;
                }
            } 
            else {
                return "Entered Bus ID or Route ID is invalid/Not-Available";
            }
        }

    public function bus_seat_management(Request $request, $role, $type){
        if($role == "super_admin" && $type == "add"){
            $bus_seats = new Bus_seates();
            $bus_seats->create($request->all());
        } else if($role == "super_admin" && $type == "edit"){
            $bus_seats = Bus_seates::findOrFail($id);
            $bus_seats->update($request->all());
            return $bus_seats;
        }
    }

    public function schedule_management(Request $request, $role, $type){
        $route = Bus_routes::where('id',$request->bus_route_id)->get();
        $is_bus_route_valid = false;

        if(count($route) > 0){ $is_bus_route_valid = true;}
        if($is_bus_route_valid == true){
            if($role == "super_admin" && $type == "add"){
                $bus_schedules = new Bus_schedules();
                $bus_schedules->create($request->all());
                return "stored successfully";

            } else if($role == "super_admin" && $type == "edit"){
                $bus_schedules = Bus_schedules::findOrFail($id);
                $bus_schedules->update($request->all());
                return $bus_schedules;
            }
        } 
        else {
            return "Entered Route Id is Invalid/Not-Available";
    }
    }
}
