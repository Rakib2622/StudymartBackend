<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clss;
class ClssController extends Controller
{
    public function getAllClss() {
      $clss = Clss::get()->toJson(JSON_PRETTY_PRINT);
      return response($clss, 200);

  }


public function getClss($id) {
      if (Clss::where('id', $id)->exists()) {
        $clss = Clss::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($clss, 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }

     public function createClss(Request $request)
   {
    $clss = new Clss();
    $clss->name = $request->input('name');



   $clss->save();
   return response()->json([
        "message" => "record created"
      ], 201);
    }



public function updateClss(Request $request, $id) {
      if (Clss::where('id', $id)->exists()) {
        $clss= Clss::find($id);

        $clss->name = is_null($request->name) ? $clss->name : $request->name;


        $clss->save();

        return response()->json([
          "message" => "records updated successfully"
        ], 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }


   public function deleteClss ($id) {
      if(Clss::where('id', $id)->exists()) {
        $clss = Clss::find($id);
        $clss->delete();

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
