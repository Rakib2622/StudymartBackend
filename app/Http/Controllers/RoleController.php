<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\role;
class RoleController extends Controller
{
    public function getAllrole() {
      $role = role::get()->toJson(JSON_PRETTY_PRINT);
      return response($role, 200);

  }


public function getrole($id) {
      if (role::where('id', $id)->exists()) {
        $role = role::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($role, 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }

     public function createrole(Request $request)
   {
    $role = new role();
    $role->name = $request->input('name');



   $role->save();
   return response()->json([
        "message" => "record created"
      ], 201);
    }



public function updaterole(Request $request, $id) {
      if (role::where('id', $id)->exists()) {
        $role= role::find($id);

        $role->name = is_null($request->name) ? $role->name : $request->name;


        $role->save();

        return response()->json([
          "message" => "records updated successfully"
        ], 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }


   public function deleterole ($id) {
      if(role::where('id', $id)->exists()) {
        $role = role::find($id);
        $role->delete();

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
