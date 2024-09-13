<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        return response()->json(['account'=>$user],200);
    }
    public function update(Request $request){
        // dd($request->all());
        $data = $request->input();
        // dd($data['name']);

        if($request->password){
            $data['password'] = Hash::make($request->password);
        }
        // dd($data);

        $user = User::findOrFail(Auth::id());
        $user->update($data);
        
        return response()->json(['success'=> "Updated Finished!"],200);
    }
}
