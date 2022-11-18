<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\message;
class MessageController extends Controller
{
    public function getAllmessage() {
      $message = message::get()->toJson(JSON_PRETTY_PRINT);
      return response($message, 200);

  }


public function getmessage($id) {
      if (message::where('id', $id)->exists()) {
        $message = message::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($message, 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }

     public function createmessage(Request $request)
   {
    $message = new message();
    $message->message = $request->input('message');
    $message->provider_id = $request->input('provider_id');
    $message->receiver_id = $request->input('receiver_id');



   $message->save();
   return response()->json([
        "message" => "record created"
      ], 201);
    }



public function updatemessage(Request $request, $id) {
      if (message::where('id', $id)->exists()) {
        $message= message::find($id);

        $message->message = is_null($request->message) ? $message->message : $request->message;
        $message->provider_id = is_null($request->provider_id) ? $message->provider_id : $request->provider_id;
        $message->receiver_id = is_null($request->receiver_id) ? $message->receiver_id : $request->receiver_id;


        $message->save();

        return response()->json([
          "message" => "records updated successfully"
        ], 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }


   public function deletemessage ($id) {
      if(message::where('id', $id)->exists()) {
        $message = message::find($id);
        $message->delete();

        return response()->json([
          "message" => "records deleted"
        ], 202);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }
}
