<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Carbon;

class AuthUserController extends Controller
{
    public function index(){
      $data = [
        [
          "name" => "royhan",
          "address" => "Tegal"
        ],[
          "name" => "delut",
          "address" => "Tegal"
        ],[
          "name" => "fadzlan",
          "address" => "Adiwerna"
        ]
      ];
      return response()->json([
        'message' => "success",
        'users' => $data
      ]);
    }
    public function register(Request $request){
      $rule = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
      ];
      $message = [
        'required' => 'isi bidang ini.',
        'email' => 'Masukan email dengan benar.',
        'unique' => ':attribute sudah terdaftar'
      ];
      $this->validate($request, $rule, $message);
      // $year = Carbon::parse(now())->formatLocalized('%A, %d %B %Y %H:%I:%S');
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
        'tanggal' => $user
      ]);
    }
}
