<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function login(Request $request){
        $data = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if($data->fails()){
            return response()->json($data->errors(),422);
        };
        $request->merge(["level"=>0]);
        if(!auth()->attempt($request->all())){
            return response()->json(["message"=>"Tk or Mk sai!"],401);
        }
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['success'=>"Logged in successfully",'token'=>$token],200);
        
    }
    public function register(Request $request){
        $data = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if($data->fails()){
            return response()->json($data->errors(),422);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 0,
        ]);
        // $token = $user->createToken("My Token")->plainTextToken;
        return response()->json(['success' => 'Thanh cong'], 201);
        
    }
    public function logout(Request $request)
    {
        // dd($request->user());
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
