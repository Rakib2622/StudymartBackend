<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
class AddressController extends Controller
{
    public function getAllAddress() {
      $adress = Address::get()->toJson(JSON_PRETTY_PRINT);
      return response($adress, 200);

  }


public function getAddress($id) {
      if (Address::where('id', $id)->exists()) {
        $adress = Address::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($adress, 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }

     public function createAddress(Request $request)
   {
    $adress = new Address();
    $adress->thana = $request->input('thana');



   $adress->save();
   return response()->json([
        "message" => "record created"
      ], 201);
    }



public function updateAddress(Request $request, $id) {
      if (Address::where('id', $id)->exists()) {
        $adress= Address::find($id);

        $adress->thana = is_null($request->thana) ? $adress->thana : $request->thana;


        $adress->save();

        return response()->json([
          "message" => "records updated successfully"
        ], 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }


   public function deleteAddress ($id) {
      if(Address::where('id', $id)->exists()) {
        $adress = Address::find($id);
        $adress->delete();

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

