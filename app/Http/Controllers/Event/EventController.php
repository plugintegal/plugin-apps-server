<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\CategoryEvent;
use App\SubCategoryEvent;
use Storage;

class EventController extends Controller
{
    public function index(){
      $results = [];
      $events = Event::orderBy('id')->get();
      return response()->json([
        "message" => "success",
        "status" => true,
        "results" => $events
      ]);
    }

    public function show($id){
      $event = Event::find($id);
      if(!$event){
        return response()->json([
          "message" => "not found",
          "status" => false,
        ], 404);
      }
      $categories = [];
      foreach ($event->categories as $categoryEvent) {
          $categories[] = [
            "name" => $categoryEvent->category->name,
            "price" => $categoryEvent->price,
            "sub_category" => $categoryEvent->subCategories
          ];
        }

      $results = (object) [
        "id" => $event->id,
        "title" => $event->title,
        "opened" => $event->opened,
        "closed" => $event->closed,
        "description" => $event->description,
        "image" => $event->image,
        "category" => $categories,
        "created_at" => $event->created_at->diffForHumans()
      ];

      return response()->json([
        "message" => "success",
        "status" => true,
        "results" => $results
      ]);
    }

    public function store(Request $request){
      $rule = [
        'title' => 'required',
        'image' => 'required|mimes:jpeg,jpg,png|max:2048',
        'category' => 'required'
      ];
      $message = [
        'required' => 'isi bidang ini.',
      ];
      $this->validate($request, $rule, $message);

      $image = $request->file('image')->store('event');
      $event = Event::create([
        'title' => $request->title,
        'image' => $image,
        'opened' => $request->opened,
        'closed' => $request->closed,
        'description' => $request->description
      ]);

      $categories = json_decode($request->category, true);

      for ($i=0; $i < count($categories); $i++) {
        $cat = CategoryEvent::create([
            "event_id" => $event->id,
            "category_id" => $categories[$i]['category_id'],
            "price" => $categories[$i]['price']
          ]);
          $subCategory = $categories[$i]['sub_category'];

          for ($j=0; $j < count($subCategory); $j++) {
            SubCategoryEvent::create([
              "category_event_id" => $cat->id,
              "sub_category_name" => $subCategory[$j]['sub_category_name'],
              "quota" => $subCategory[$j]['quota']
            ]);
          }
      }
      return response()->json([
        "message" => "success",
        "status" => true
      ]);
    }

}
