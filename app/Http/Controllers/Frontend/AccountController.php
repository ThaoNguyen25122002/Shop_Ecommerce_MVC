<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    public function showAccount(){
        $user = Auth::user();
        return view('frontend.account.account',['user'=> $user]);
    }
    public function updateAccount(Request $request){
        // dd(Auth::id());
        // dd($request->input());
        $user = User::findOrFail(Auth::id());
        $data = $request->input();
        if(!empty($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }else{
            $data['password'] = $user->password;
        }
        if($request->hasFile('avatar')){
            $file = $request->avatar;
            $ex = $file->extension();
            $file_name = time().'-avatar.'.$ex;
            $path = public_path('admin/assets/avatar');
            $file->move($path,$file_name);
            $data['avatar'] = $file_name;
        }
        $user->update($data);
        return redirect()->back()->with('success','Update finished!');
    }

    
}
