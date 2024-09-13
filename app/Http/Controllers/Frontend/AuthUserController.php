<?php

namespace App\Http\Controllers\Frontend;
use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthUserController extends Controller
{
    //
    public function register(RegisterUserRequest $request){
        // dd($request->validated());
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['level'] = 0;
        // dd($data);
        $user = User::create($data);
        return redirect('/login')->with('success', 'Đăng ký tài khoản thành công!');
    }
    public function login(LoginUserRequest $request){
        // dd($request->validated());
        // $user = $request->only('email','password','level');
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0,
        ];
        $remember = $request->filled('remember');
        if (Auth::attempt($login, $remember)) {
            return redirect("/");
        }
        return redirect()->back()->with('error', 'Email hoặc Password không đúng!');
   
    }

    
    
}
