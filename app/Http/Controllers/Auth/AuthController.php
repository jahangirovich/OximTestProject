<?php

namespace App\Http\Controllers\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AuthController extends BaseController{

	public function register (Request $request) {
	    $validator = Validator::make($request->all(), [
	        'name' => 'required|string|max:255',
	        'email' => 'required|string|email|max:255|unique:users',
	        'password' => 'required|string|min:6|confirmed',
	    ]);
	    if ($validator->fails())
	    {
	        return $this->errorResponse('error',['not valid'], 422);
	    }
	    $request['password']=Hash::make($request['password']);
	    $request['remember_token'] = Str::random(10);
	    $user = User::create($request->toArray());
	    $token = $user->createToken('Laravel Password Grant Client')->accessToken;
	    $user->remember_token=$token;
	    $user->save();
	    $response = ['token' => $token];
	    return $this->showResponse($response,200);
	}
	public function login (Request $request) {
	    $validator = Validator::make($request->all(), [
	        'email' => 'required|string|email|max:255',
	        'password' => 'required|string|min:6',
	    ]);
	    if ($validator->fails())
	    {
	        return $this->errorResponse('error','not valid',200);
	    }
	    $user = User::where('email', $request->email)->first();
	    if ($user) {
	        if (Hash::check($request->password, $user->password)) {
	            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
	            $response = ['token' => $token];
	            return $this->showResponse($response,200);
	        } else {
	            $response = ["message" => "Password mismatch"];
	            return $this->errorResponse($response,200);
	        }
	    } else {
	        $response = ["message" =>'User does not exist'];
	        return $this->errorResponse($response,200);
	    }
	}
} 