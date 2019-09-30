<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

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
        'email' => 'required|email',
        'phone' => 'required|numeric|min:10|max:13'

      ];
      $message = [
        'required' => 'isi bidang ini.',
        'email' => 'Masukan email dengan benar.',
        'min' => 'minimal :attribute'
      ];
      $this->validate($request, $rule, $message);
    }
}
