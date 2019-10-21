<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class AuthAdminController extends Controller
{
    public function login(Request $request){
      $credential = [
        'member_id' => $request->member_id,
        'password' => $request->password
      ];
        if(!Auth::attempt($credential, $request->member)){
          return response()->json([
            'message' => 'login failed',
            'status' => false
          ]);
        }

        $user = User::find(Auth::user()->member_id);
        if($user->role == "anggota"){
          return response()->json([
            'message' => 'login failed',
            'status' => false
          ]);
        }

        return response()->json([
          'message' => 'login success',
          'status' => true,
          'results' => $user
        ]);
    }
}
