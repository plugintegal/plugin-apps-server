<?php

namespace App\Http\Controllers\Event;

use App\Events;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventsController extends Controller
{
    public function index(){
        return Events::all();
    }

    public function create(Request $req){
        $events = new Events;
        $result = [];
        $events->event_id = $req->event_id;
        $events->event_name = $req->event_name;
        $events->location = $req->location;
        $events->time = $req->time;
        $events->registration_fee = $req->registration_fee;
        $events->description = $req->description;
        $events->save();
    }
}
