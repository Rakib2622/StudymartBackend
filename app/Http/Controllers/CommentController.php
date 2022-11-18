<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comment;
class commentController extends Controller
{
    public function getAllcomment() {
      $comment = comment::get()->toJson(JSON_PRETTY_PRINT);
      return response($comment, 200);

  }


public function getcomment($id) {
      if (comment::where('id', $id)->exists()) {
        $comment = comment::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($comment, 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }

     public function createcomment(Request $request)
   {
    $comment = new comment();
    $comment->comment = $request->input('comment');
    $comment->user_id = $request->input('user_id');
    $comment->post_id = $request->input('post_id');




   $comment->save();
   return response()->json([
        "message" => "record created"
      ], 201);
    }



public function updatecomment(Request $request, $id) {
      if (comment::where('id', $id)->exists()) {
        $comment= comment::find($id);

        $comment->comment = is_null($request->comment) ? $comment->comment : $request->comment;
        $comment->user_id = is_null($request->user_id) ? $comment->user_id : $request->user_id;
        $comment->post_id = is_null($request->post_id) ? $comment->post_id : $request->post_id;


        $comment->save();

        return response()->json([
          "message" => "records updated successfully"
        ], 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }


   public function deletecomment ($id) {
      if(comment::where('id', $id)->exists()) {
        $comment = comment::find($id);
        $comment->delete();

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

