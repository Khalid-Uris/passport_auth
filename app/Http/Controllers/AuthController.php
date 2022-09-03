<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // return "hello";
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $user = new User();
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(10);
        $user->save();


        // $request['password'] = Hash::make($request->password);
        // $request['remember_token'] = Str::random(10);

        // $user = User::create($request->toArray());


        //return $request->email;
        //$message = $request;
        $response = response()->json([
            'message' => 'success',
        ]);



        return $response;
    }
}