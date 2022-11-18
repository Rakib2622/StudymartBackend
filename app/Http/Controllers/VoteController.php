<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
class VoteController extends Controller
{
    public function getAllVote() {
      $vote = Vote::get()->toJson(JSON_PRETTY_PRINT);
      return response($vote, 200);

  }


public function getVote($id) {
      if (Vote::where('id', $id)->exists()) {
        $vote = Vote::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($vote, 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }

     public function createVote(Request $request)
   {
    $vote = new Vote();
    $vote->upvote = $request->input('upvote');
    $vote->downvote = $request->input('downvote');
    $vote->userid = $request->input('userid');



   $vote->save();
   return response()->json([
        "message" => "record created"
      ], 201);
    }



public function updateVote(Request $request, $id) {
      if (Vote::where('id', $id)->exists()) {
        $vote= Vote::find($id);

        $vote->upvote = is_null($request->upvote) ? $vote->upvote : $request->upvote;
        $vote->downvote = is_null($request->downvote) ? $vote->downvote : $request->downvote;
        $vote->userid = is_null($request->userid) ? $vote->userid : $request->userid;


        $vote->save();

        return response()->json([
          "message" => "records updated successfully"
        ], 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }


   public function deleteVote ($id) {
      if(Vote::where('id', $id)->exists()) {
        $vote = Vote::find($id);
        $vote->delete();

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
