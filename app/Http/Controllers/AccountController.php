<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
class AccountController extends Controller
{
    public function getAllAccount() {
      $account = Account::get()->toJson(JSON_PRETTY_PRINT);
      return response($account, 200);

  }


public function getAccount($id) {
      if (Account::where('id', $id)->exists()) {
        $account = Account::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($account, 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }

     public function createAccount(Request $request)
   {
    $account = new Account();
    $account->ammount = $request->input('ammount');



    $account->save();
    return response()->json([
            "message" => "record created"
        ], 201);
    }



public function updateAccount(Request $request, $id) {
      if (Account::where('id', $id)->exists()) {
        $account= Account::find($id);

        $account->ammount = is_null($request->ammount) ? $account->ammount : $request->ammount;


        $account->save();

        return response()->json([
          "message" => "records updated successfully"
        ], 200);
      } else {
        return response()->json([
          "message" => "not found"
        ], 404);
      }
    }


   public function deleteAccount ($id) {
      if(Account::where('id', $id)->exists()) {
        $account = Account::find($id);
        $account->delete();

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

