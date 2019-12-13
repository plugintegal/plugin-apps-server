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
      // $rule = [
      //   'title' => 'required',
      //   'image' => 'required|mimes:jpeg,jpg,png|max:2048',
      //   'category' => 'required'
      // ];
      // $message = [
      //   'required' => 'isi bidang ini.',
      // ];
      // $this->validate($request, $rule, $message);

      $event = Event::create([
        "title" => $request->title
      ]);

      $categories = json_decode($request->category);
      foreach ($categories as $category) {
        $cat = CategoryEvent::create([
          "event_id" => $event->id,
          "category_id" => $category->category_id,
          "price" => $category->price
        ]);
        $subCategories = $category->sub_category;
        if($subCategories > 0){
          foreach ($subCategories as $subCategory) {
            SubCategoryEvent::create([
              "category_event_id" => $cat->id,
              "sub_category_name" => $subCategory->sub_category_name,
              // "quota" => $subCategory->quota
            ]);
          }
        }
      }

      // $results = [
      //   "image" => $request->image,
      // ];
      // $image = $request->file("image");
      return response()->json([
        "message" => "success",
        "status" => true,

      ]);
    }
}
