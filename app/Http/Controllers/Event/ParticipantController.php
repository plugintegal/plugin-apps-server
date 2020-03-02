<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Participant;
use App\SubCategoryEvent;
use Snowfire\Beautymail\Beautymail;

class ParticipantController extends Controller
{
    public function store(Request $request){
      $rule = [
        'event_id' => 'required',
        'full_name' => 'required',
        'email' => 'required|email|unique:participants',
        'phone' => 'required|unique:participants',
        'institution' => 'required',
        'address' => 'required',
        'date_of_birth' => 'required',
        'sub_category_id' => 'required'
      ];
      $message = [
        'required' => 'isi bidang ini.',
        'email.unique' => 'Email sudah terdaftar',
        'phone.unique' => 'No Telepon sudah terdaftar',
      ];
      $this->validate($request, $rule, $message);

      $subCategory = $request->sub_category_id;
      $subCategoryEvent = SubCategoryEvent::where('id', $subCategory)->first();
      if($subCategoryEvent->quota == 0){
        return response()->json([
          'message' => 'Maaf kuota untuk '.$subCategoryEvent->categoryEvent->category->name.' '
          .$subCategoryEvent->sub_category_name.' sudah penuh',
          'status' => false,
        ]);
      }

      $dataParticipant = Participant::where('sub_category_event_id', $subCategory)
      ->orderBy('id', 'DESC')->first();

      $generate = "EV-PLGN";
      $id = $request->event_id+0001;
      if($dataParticipant != null){
        $id = substr($dataParticipant->id, 7)+1;
      }
      $generateId = $generate.$id;
      $participant = Participant::create([
        'id' => $generateId,
        'event_id' => $request->event_id,
        'full_name' => $request->full_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'institution' => $request->institution,
        'address' => $request->address,
        'date_of_birth' => $request->date_of_birth,
        'description' => $subCategoryEvent->categoryEvent->category->name.' '.$subCategoryEvent->sub_category_name,
        'sub_category_event_id' => $request->sub_category_id
      ]);

      $data = (object) [
        "participant" => $participant,
        "event" => $participant->event->title
      ];

      $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
      $beautymail->send('emails.welcome',['data' => $data], function($message) use($data)
        {
            $message
    			->from('plugintegal@gmail.com')
    			->to($data->participant['email'], $data->participant['full_name'])
    			->subject($data->event);
        });

      return response()->json([
        'message' => 'success',
        'status' => true
      ]);
    }

    public function index(){
      $participants = Participant::all();
      return response()->json([
        'message' => 'success',
        'status' => true,
        'results' => $participants
      ]);
    }
}
