<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\review;
class ReviewController extends Controller
{
    public function getAllreview() {
      $review = review::get()->toJson(JSON_PRETTY_PRINT);
      return response($review, 200);

  }


public function getreview($id) {
      if (review::where('id', $id)->exists()) {
        $review = review::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($review, 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }

     public function createreview(Request $request)
   {
    $review = new review();
    $review->rating = $request->input('rating');
    $review->review = $request->input('review');
    $review->provider_id = $request->input('provider_id');
    $review->receiver_id = $request->input('receiver_id');




   $review->save();
   return response()->json([
        "message" => "record created"
      ], 201);
    }



public function updatereview(Request $request, $id) {
      if (review::where('id', $id)->exists()) {
        $review= review::find($id);

        $review->rating = is_null($request->rating) ? $review->rating : $request->rating;
        $review->review = is_null($request->review) ? $review->review : $request->review;
        $review->provider_id = is_null($request->provider_id) ? $review->provider_id : $request->provider_id;
        $review->receiver_id = is_null($request->receiver_id) ? $review->receiver_id : $request->receiver_id;


        $review->save();

        return response()->json([
          "message" => "records updated successfully"
        ], 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }


   public function deletereview ($id) {
      if(review::where('id', $id)->exists()) {
        $review = review::find($id);
        $review->delete();

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

