<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\advertisement;
class AdvertisementController extends Controller
{
    public function getAlladvertisement() {
      $advertisement = advertisement::get()->toJson(JSON_PRETTY_PRINT);
      return response($advertisement, 200);

  }


public function getadvertisement($id) {
      if (advertisement::where('id', $id)->exists()) {
        $advertisement = advertisement::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($advertisement, 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }

     public function createadvertisement(Request $request)
   {
    $advertisement = new advertisement();
    $advertisement->content = $request->input('content');
    $advertisement->image = $request->input('image');
    $advertisement->user_id = $request->input('user_id');




   $advertisement->save();
   return response()->json([
        "message" => "record created"
      ], 201);
    }



public function updateadvertisement(Request $request, $id) {
      if (advertisement::where('id', $id)->exists()) {
        $advertisement= advertisement::find($id);

        $advertisement->content = is_null($request->content) ? $advertisement->content : $request->content;
        $advertisement->image = is_null($request->image) ? $advertisement->image : $request->image;
        $advertisement->user_id = is_null($request->user_id) ? $advertisement->user_id : $request->user_id;


        $advertisement->save();

        return response()->json([
          "message" => "records updated successfully"
        ], 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }


   public function deleteadvertisement ($id) {
      if(advertisement::where('id', $id)->exists()) {
        $advertisement = advertisement::find($id);
        $advertisement->delete();

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

