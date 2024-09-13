<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Blog;
use App\Models\History;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.dashboard');
    }
    //================ Handle Profile ===============//
    public function showProfile(){
        $user = Auth::user();
        $countries = Country::all();
        return view('admin/profile/profile',['user'=>$user,'countries'=>$countries]);

    }
    public function updateProfile(ProfileRequest $request){
        // $user = Auth::user;
        $userId = Auth::id();
        $userData = User::findOrFail($userId);
        $data = $request->input();
        if($request->hasFile('avatar')){
            $file = $request->avatar;
            $ex = $file->extension();
            $file_name = time().'-avatar.'.$ex;
            $path = public_path('admin/assets/avatar');
            $file->move($path,$file_name);
            $data['avatar'] = $file_name;
        }
        if (!empty($data['password'])) {
            // Mật khẩu được mã hóa trước khi lưu vào cơ sở dữ liệu
            $data['password'] = Hash::make($data['password']);
        }else{
            $data['password'] = $userData->password;
        }
        $userData->update($data);
        return redirect()->back();
    }
    //================ Handle Country ===============//
    public function showCountry(){
        $countries = Country::all();
        // dd($countries->toArray());
        return view('admin/countries/country',['countries' => $countries]);
    }
    public function formEditCountry($id){
        $country = Country::findOrFail($id);
        return view('admin.countries.edit_country',['country'=>$country]);
    }
    public function updateCountry(Request $request){
        $country = Country::findOrFail($request->id);
        $country->name = $request->name;
        $country->update();
        return redirect('admin/country');
    }
    public function deleteCountry($id){
        $country = Country::find($id);
        $country->delete();
        return redirect()->back();
    }
    public function createCountry(Request $request){
        $data = $request->validate([
            'name' => 'required'
        ]);
        $newCountry = Country::create($data);
        return redirect('admin/country');
    }


    // ================= Handle Blogs ================ //
    public function showBlog(){
        $blogs = Blog::all();
        // dd($countries->toArray());
        return view('admin.blogs.blog',['blogs' => $blogs]);
    }

    public function createBlog(Request $request){
        // dd($request->all());
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,webp,gif|max:2048',
            'content' => 'required',
        ]);
        if($request->hasFile('image')){
            $file = $request->image;
            $ex = $file->extension();
            $file_name = time().'-image.'.$ex;
            $path = public_path('admin/assets/blogs');
            $file->move($path,$file_name);
            $data['image'] = $file_name;
        }
        Blog::create($data);
        return redirect('admin/blogs');
    }
    public function editBlog($id){
        $blog = Blog::findOrFail($id);
        // dd($blog->title);
        return view('admin.blogs.form_edit_blog',['blog' => $blog]);
    }
    public function updateBlog($id, Request $request){
        $blog = Blog::findOrFail($id);
        $data = $request->all();
        if($request->hasFile('image')){
            $file = $request->image;
            $ex = $file->extension();
            $file_name = time().'-image.'.$ex;
            $path = public_path('admin/assets/blogs');
            $file->move($path,$file_name);
            $data['image'] = $file_name;
        }
        $blog->update($data);
        return redirect('admin/blogs');
    }
    public function deleteBlog($id){
        $blog = Blog::findOrFail($id);
        // dd($blog->title);
        $blog->delete();
        return redirect()->back();
    }


    //======================= Handle History =================//
    public function showHistories(){
        $histories = Order::all();
        return view('admin.history.history',['histories'=>$histories]);
    }

    

}
