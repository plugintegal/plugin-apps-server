<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Personal;
use Auth;
use DateTime;

class PersonalController extends Controller
{
  public function __construct(){
    $this->middleware('auth:api');
  }

  public function updatePersonal(Request $request){
    $personal = Personal::find(Auth::user()->member_id);
    $user_id = $personal->user_id;
    $rule = [
      'nickname' => 'required',
      'phone' => "required|unique:personals,phone,$user_id,user_id",
      'date_of_birth' => 'required',
      'place_of_birth' => 'required',
      'address' => 'required',
      'nim' => "required|unique:personals,nim,$user_id,user_id",
      'telegram' => "required|unique:personals,telegram,$user_id,user_id",
      'github' => "required|unique:personals,github,$user_id,user_id",
      'class' => 'required',
      'bio' => 'required'
    ];
    $message = [
      'required' => 'isi bidang ini.',
      'unique' => ':attribute sudah terdaftar'
    ];
    $this->validate($request, $rule, $message);

    $date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
    $personal->update([
      'nickname' => $request->nickname,
      'phone' => $request->phone,
      'date_of_birth' => $date_of_birth,
      'place_of_birth' => $request->place_of_birth,
      'address' => $request->address,
      'nim' => $request->nim,
      'telegram' => $request->telegram,
      'github' => $request->github,
      'class' => $request->class,
      'bio' => $request->bio,
      'updated_at' => now()
    ]);

    return response()->json([
      'message' => 'update success',
      'status' => true
    ], 200);
  }
}
