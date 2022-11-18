<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\notification;
class NotificationController extends Controller
{
    public function getAllnotification() {
      $notification = notification::get()->toJson(JSON_PRETTY_PRINT);
      return response($notification, 200);

  }


public function getnotification($id) {
      if (notification::where('id', $id)->exists()) {
        $notification = notification::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($notification, 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }

     public function createnotification(Request $request)
   {
    $notification = new notification();
    $notification->notification = $request->input('notification');
    $notification->user_id = $request->input('user_id');



   $notification->save();
   return response()->json([
        "message" => "record created"
      ], 201);
    }



public function updatenotification(Request $request, $id) {
      if (notification::where('id', $id)->exists()) {
        $notification= notification::find($id);

        $notification->notification = is_null($request->notification) ? $notification->notification : $request->notification;
        $notification->user_id = is_null($request->user_id) ? $notification->user_id : $request->user_id;


        $notification->save();

        return response()->json([
          "message" => "records updated successfully"
        ], 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }


   public function deletenotification ($id) {
      if(notification::where('id', $id)->exists()) {
        $notification = notification::find($id);
        $notification->delete();

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
