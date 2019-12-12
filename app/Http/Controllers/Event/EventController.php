<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\CategoryEvent;
use App\SubCategoryEvent;

class EventController extends Controller
{
    public function index(){
      $results = [];
      $events = Event::all();
      foreach ($events as $event) {
        $categories = [];
        foreach ($event->categories as $categoryEvent) {
          $categories[] = [
            "name" => $categoryEvent->category->name,
            "price" => "Rp. ".number_format($categoryEvent->price,0,',','.'),
            "sub_category" => $categoryEvent->subCategories
          ];
        }

        $results[] = [
          "title" => $event->title,
          "category" => $categories,
          "created_at" => $event->created_at->diffForHumans()
        ];
      }
      return response()->json([
        "message" => "success",
        "status" => true,
        "results" => $results
      ]);
    }

    public function store(Request $request){

      $event = Event::create([
        "title" => $request->title
      ]);

      $categories = $request->category;
      $categories = array_map(function($array){
        return (object)$array;
      },$categories);
      foreach ($categories as $category) {
        $cat = CategoryEvent::create([
          "event_id" => $event->id,
          "category_id" => $category->category_id,
          "price" => $category->price
        ]);
        $subCategories = $category->sub_category;
        $subCategories = array_map(function($array){
          return (object)$array;
        },$subCategories);
        if($subCategories > 0){
          foreach ($subCategories as $subCategory) {
            SubCategoryEvent::create([
              "category_event_id" => $cat->id,
              "sub_category_name" => $subCategory->sub_category_name
            ]);
          }
        }
      }

      return response()->json([
        "message" => "success",
        "status" => true
        //dd(count($subCat))
      ]);
    }
}
