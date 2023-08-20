<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\message;
class MessageController extends Controller
{

    public function createmessage(Request $request) {
        $message = new message();
        $message->message = $request->message;
        $message->provider_id = $request->provider_id;
        $message->receiver_id = $request->receiver_id;
        $message->save();

        return response()->json($message);
    }

    public function getmessage($userid, $senderid) {
        $messages = DB::table('messages')
                        ->where(function ($query) use($userid, $senderid) {
                            $query->where('provider_id', $userid)
                                  ->where('receiver_id', $senderid);
                        })
                        ->orWhere(function ($query) use($userid, $senderid) {
                            $query->where('provider_id', $senderid)
                                  ->where('receiver_id', $userid);
                        })
                        ->orderBy('created_at')
                        ->get()
                        ->reverse()
                        ->values();

        return response()->json($messages);
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

    public function getmessagelist($id) {
        $messages = DB::table('messages')
                            ->join('users as u1', 'messages.receiver_id', '=', 'u1.id')
                            ->join('users as u2', 'messages.provider_id', '=', 'u2.id')
                            ->where('provider_id', $id)
                            ->orWhere('receiver_id', $id)
                            ->select('messages.*', 'u1.id as u1id', 'u1.name as u1name', 'u1.image as u1image', 'u2.id as u2id', 'u2.name as u2name', 'u2.image as u2image')
                            ->orderBy('messages.created_at')
                            ->get()
                            ->reverse()
                            ->values();
        return response()->json($messages);
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
