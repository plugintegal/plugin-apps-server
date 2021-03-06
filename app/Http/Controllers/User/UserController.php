<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Support\Carbon;
use Storage;

class UserController extends Controller
{
    public function __construct(){
      $this->middleware('auth:api');
    }

    public function index(){
      $users = User::orderBy('member_id','DESC')->get();
      $result = [];
      foreach ($users as $user) {
        $result[] = [
          'member_id' => $user->member_id,
          'name' => $user->name,
          'email' => $user->email,
          'role' => $user->role,
          'avatar' => $user->avatar
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
        'avatar' => $user->avatar,
        'status' => $user->status == true ? 'Aktif' : 'Nonaktif',
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
          'avatar' => $user->avatar,
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

    public function update(Request $request){
      $user = User::find(Auth::user()->member_id);
      $rule = [
        'name' => 'required',
        'email' => "required|unique:users,email,$user->member_id,member_id",
        'role' => 'required',
        'image' => 'mimes:jpeg,jpg,png|max:2048',
      ];
      $message = [
        'required' => 'isi bidang ini.',
        'unique' => ':attribute sudah terdaftar',
        'image.mimes' => 'Masukan gambar JPEG,JPG,PNG',
        'image.uploaded' => 'Gambar maksimal 2MB',
      ];
      $this->validate($request, $rule, $message);
      $avatar = $user->avatar;
      if($request->avatar){
        $avatar = $request->file('avatar')->store('avatar');
        if (!$user->avatar === 'avatar/default.png') {
          $avatar_path = $avatar;
          if (Storage::exists($avatar_path)) {
            Storage::delete($avatar_path);
          }
        }
      }
      $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'avatar' => $avatar,
      ]);

      return response()->json([
        'message' => 'success',
        'status' => true,
      ], 200);

    }

}
