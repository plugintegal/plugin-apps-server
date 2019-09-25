<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index(){
      return response()->json([
        'message' => "success"
      ]);
    }
    public function register(Request $request){
      $rule = [
        'name' => 'required',
        'email' => 'required|email|unique:users'
      ];
      $message = [
        'required' => 'isi bidang ini.',
        'email' => 'Masukan email dengan benar'
      ];
      $this->validate($request, $rule, $message);
    }
}
