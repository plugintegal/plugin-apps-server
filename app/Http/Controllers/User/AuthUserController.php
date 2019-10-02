<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class AuthUserController extends Controller
{
    public function register(Request $request){
      $rule = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
      ];
      $message = [
        'required' => 'isi bidang ini.',
        'email' => 'Masukan email dengan benar.',
        'unique' => ':attribute sudah terdaftar'
      ];
      $this->validate($request, $rule, $message);
      $user = User::orderBy('member_id','DESC')->first();
      $userID = 1;
      if($user != null){
        $userID = substr($user->member_id,6)+1;
      }
      $year = substr(now()->format('Y'),2);
      $id = str_pad(0000+$userID, 4, 0, STR_PAD_LEFT);
      $member_id = "PLGN".$year.$id;
      $user = User::create([
        'member_id' => $member_id,
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'api_token' => bcrypt($request->email),
        'role' => $request->role
      ]);
      return response()->json([
        'message' => 'success',
        'status' => true
      ], 201);
    }

    public function login(Request $request){
      $rule = [
        'member_id' => 'required|max:10|min:10',
        'password' => 'required|min:6'
      ];
      $message = [
        'required' => 'isi bidang ini.',
      ];
      $this->validate($request, $rule, $message);

      $credential = [
        'member_id' => $request->member_id,
        'password' => $request->password
      ];

      if(!Auth::attempt($credential, $request->member)){
        return response()->json([
            'message' => 'login failed',
            'status' => false
        ], 401);
      }
      $user = User::find(Auth::user()->member_id);
      return response()->json([
        'message' => 'login success',
        'status' => true,
        'user' => $user
      ], 201);
    }
}
