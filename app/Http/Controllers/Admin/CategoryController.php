<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\User;
use App\CategoryEvent;
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
      $rule = [ 'name' => 'required|min:3|max:30'];
      $message = [
        'required' => 'Isi bidang ini.',
        'min' => 'Nama kategori minimal 3 huruf.',
        'max' => 'Nama kategori maksimal 30 huruf.'
      ];
      $this->validate($request, $rule, $message);

      $user = User::find(Auth::user()->member_id);
      if ($user->role == "anggota") {
        return response()->json([
          "message" => "failed",
          "status" => false,
        ]);
      }
      $name = ucwords(strtolower($request->name));
      $categoryName = Category::where('name', $name)->first();
      if($categoryName){
        return response()->json([
          'message' => 'failed',
          'status' => false,
          'errors' => 'Nama Kategori '.$name.' sudah ada.'
        ]);
      }

      Category::create(["name" => $name]);
      return response()->json(["message" => "success","status" => true]);
    }

    public function update(Request $request, Category $category){
      $rule = [ 'name' => 'required|min:3|max:30'];
      $message = [
        'required' => 'Isi bidang ini.',
        'min' => 'Nama kategori minimal 3 huruf.',
        'max' => 'Nama kategori maksimal 30 huruf.'
      ];
      $this->validate($request, $rule, $message);

      $user = User::find(Auth::user()->member_id);
      if ($user->role == "anggota") {
        return response()->json([
          "message" => "failed",
          "status" => false,
        ]);
      }

      $name = ucwords(strtolower($request->name));
      $categoryName = Category::where('name', $name)->first();

      if($name == $category->name){
        return response()->json(['message' => 'success','status' => true]);
      }elseif($categoryName){
        return response()->json([
          'message' => 'failed',
          'status' => false,
          'errors' => 'Nama Kategori '.$name.' sudah ada.'
        ]);
      }

      $category->update(['name' => $name]);

      return response()->json(['message' => 'success','status' => true]);
    }

    public function destroy(Category $category){
      $user = User::find(Auth::user()->member_id);
      if ($user->role == "anggota") {
        return response()->json([
          "message" => "failed",
          "status" => false,
        ]);
      }

      $categoryEvent = CategoryEvent::where('category_id', $category->id)->first();

      if($categoryEvent){
        return response()->json([
          'message' => 'failed',
          'status' => false,
          'errors' => 'Kategori '.$categoryEvent->category->name.' sedang digunakan.'
        ]);
      }

      $category->delete();
      return response()->json(['message' => 'success','status' => true]);
    }
}
