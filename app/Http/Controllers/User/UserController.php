<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index(){
      $users = User::all();
      $result = [];
      foreach ($users as $user) {
        $result[] = [
          'member_id' => $user->member_id,
          'name' => $user->name,
          'email' => $user->email,
          'role' => $user->role,
          'avatar' => $user->avatar,
          // 'created_at' => Carbon::parse($user->created_at)->formatLocalized('%A, %d %B %Y'),
          // 'updated_at' => Carbon::parse($user->updated_at)->formatLocalized('%A, %d %B %Y')
        ];
      }
      return response()->json([
        'message' => 'success',
        'status' => true,
        'results' => $result
      ], 200);
    }

    public function profile(){
      $user = User::find(Auth::user()->member_id);
      $data = [
        'member_id' => $user->member_id,
        'name' => $user->name,
        'email' => $user->email,
        'role' => $user->role,
        'created_at' => Carbon::parse($user->created_at)->formatLocalized('%A, %d %B %Y'),
        'updated_at' => Carbon::parse($user->updated_at)->formatLocalized('%A, %d %B %Y'),
        'personal' => $user->personal,
        'colaborations' => [],
        'achievement' => []
      ];
      return response()->json([
        'message' => 'success',
        'status' => true,
        'results' => $data
      ], 200);
    }

    public function show($member_id){
      $user = User::where('member_id', $member_id)->first();
      $data = [];
      if($user != null){
        $data = [
          'member_id' => $user->member_id,
          'name' => $user->name,
          'email' => $user->email,
          'role' => $user->role,
          'status' => $user->status == true ? 'Aktif' : 'Nonaktif',
          'created_at' => Carbon::parse($user->created_at)->formatLocalized('%A, %d %B %Y'),
          'updated_at' => Carbon::parse($user->updated_at)->formatLocalized('%A, %d %B %Y'),
          'personal' => $user->personal,
          'colaborations' => [],
          'achievement' => []
        ];
      }
      return response()->json([
        'message' => 'success',
        'status' => true,
        'results' => $data
      ], 200);
    }

    // public function update(){
    //   $user = User::find(Auth::user()->member_id);
    // }
}
