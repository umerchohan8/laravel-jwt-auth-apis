<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Houses;
use App\User;

class HouseController extends Controller
{
    /**
     * Create a new HouseController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function addHouse(Request $request){
        if(auth()->user()->role == 'Admin'){  
            $house = new Houses;
            $house->house_number        = $request->input('house_number');
            $house->block               = $request->input('block');
            $house->street              = $request->input('street');
            $house->reference_number    = mt_rand(10000, 99999);
            $house->user_id             = $request->input('user_id');
            $house->owner_name          = $request->input('owner_name');
            $house->save();
            return response()->json(['success' => 'House added successfully.'], 200);
        }
    }


    public function updateHouse(Request $request, $id){
        if(auth()->user()->role == 'Admin'){
            $house = Houses::find($id);
            if($house){
                $house->house_number    = $request->input('house_number');
                $house->block           = $request->input('block');
                $house->street          = $request->input('street');
                $house->user_id         = $request->input('user_id');
                $house->owner_name      = $request->input('owner_name');
                $house->save();
                return response()->json(['success' => 'House updated successfully.'], 200);
            }
            else{
                return response()->json(['error' => 'House does not exist.'], 401);
            }
        }

        
    }



    public function deleteHouse($id){
        if(auth()->user()->role == 'Admin'){
            $house = Houses::find($id);
            if($house){
                $house->delete();
                return response()->json(['success' => 'House deleted successfully.'], 200);
            }
            else{
                return response()->json(['error' => 'House does not exist.'], 401);
            }
        }
    }



    public function getMyHouses(){
        if(auth()->user()->role == 'User'){
            $loggedInUserId = auth()->user()->id;
            $houses = User::find($loggedInUserId)->houses;
            return response()->json(['houses' => $houses], 200);
        }
    }



    public function getUserHouses($id){
        if(auth()->user()->role == 'Admin'){
            $houses = User::find($id)->houses;
            return response()->json(['houses' => $houses], 200);
        }
    }


}
