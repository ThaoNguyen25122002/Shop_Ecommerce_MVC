<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index(){
        $blogs = Blog::paginate(3);
        // dd($data);
        // return response()->json($blogs, 200);
        return BlogResource::collection($blogs);
    }
    public function showBlogDetail($id){
        $blog = Blog::with('comments.children')->findOrFail($id);
        return response()->json(['blog'=>$blog, 'comments'=>$blog->comments],200);
        // $blog = Blog::findOrFail($id);
        // $comments = Comment::with('children')->where('id_blog',$id)->where('level',0)->get();
        // return response()->json(['comments'=>$comments,'blog'=>$blog],200);

        // return new BlogResource($blog);
    }
}
