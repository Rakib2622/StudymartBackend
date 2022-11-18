<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('mobile_no', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = JWTAuth::setToken($token)->toUser();

        return response()->json(compact('token', 'user'));
    }

    public function register(Request $request)
    {

        $user = new User();

        $user->name = $request->name;
        $user->mobile_no = $request->mobile_no;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'],
                $e->getStatusCode()
            );
        }

        return response()->json(compact('user'));
    }

    public function userlist() {
        $users = User::all();

        return response()->json($users);
    }

    public function userupdate(Request $request) {
        $users = User::where('id', $request->id)->first();

        $users->email = $request->email;
        $users->dob = $request->dob;
        $users->gender = $request->gender;
        $users->occupation = $request->occupation;
        $users->identity_no = $request->nid;
        $users->address = $request->address;
        $users->institute = $request->institute;
        $users->passing_year = $request->passingYear;
        $users->degree = $request->degree;

        $users->save();

        return response()->json($users);

    }

    public function changepassword(Request $request, $id) {
        $user = User::find($id);

        if($user->password == md5($request->current_password)) {
            if($request->new_password == $request->confirm_password) {
                $user->password = md5($request->new_password);
                $user->save();

                return response()->json("Successfully changed password");
            }
            else {
                return response()->json("Password don't match");
            }
        }

        else {
            return response()->json("Invalid Password");
        }
    }

    public function userdelete($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json("User delete successfully");
    }

    public function getauthuser(Request $request)
    {
        $user = JWTAuth::setToken($request->token)->toUser();
        return response()->json($user);
    }
}

