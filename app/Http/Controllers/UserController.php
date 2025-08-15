<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    function register(Request $request){
        $newUser=User::create([

        'UserName'=>$request->input('UserName'),
        'Email'=>$request->input('Email'),
        'Password' => Hash::make($request->input('Password')),

        ]);
        return $newUser;
    }

    function login(Request $request){

        $user = User:: where ("Email", $request->input("Email"))->first();

        if(!$user) {
            return response()->json(["message"=>"User not found"], 401);
        }

        if(!Hash::check($request->input("Password"), $user->Password)) {
            return response()->json(["message" => "Wrong password"], 401);

        }

        $token = $user->createToken("auth_token");
        return response()->json(["token" => $token->plainTextToken]);
    }
}
