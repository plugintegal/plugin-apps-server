<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\User;
use Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    public function index(){
      $categories = Category::all();
      return response()->json([
        "message" => "success",
        "status" => true,
        "results" => $categories
      ]);
    }

    public function store(Request $request){
      $user = User::find(Auth::user()->member_id);
      if ($user->role == "anggota") {
        return response()->json([
          "message" => "failed",
          "status" => false,
        ]);
      }
      Category::create([
        "name" => $request->name
      ]);
      return response()->json([
        "message" => "success",
        "status" => true,
      ]);
    }

    public function update(Request $request, Category $category){
      $user = User::find(Auth::user()->member_id);
      if ($user->role == "anggota") {
        return response()->json([
          "message" => "failed",
          "status" => false,
        ]);
      }
      $category->update([
        "name" => $request->name
      ]);
      return response()->json([
        "message" => "success",
        "status" => true,
      ]);
    }

    public function destroy(Category $category){
      $user = User::find(Auth::user()->member_id);
      if ($user->role == "anggota") {
        return response()->json([
          "message" => "failed",
          "status" => false,
        ]);
      }
      $category->delete();
      return response()->json([
        "message" => "success",
        "status" => true,
      ]);
    }
}
