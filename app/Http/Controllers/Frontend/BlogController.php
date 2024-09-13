<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Rating;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    
    public function blogList(){
        $blogs = Blog::paginate(3);
        return view('frontend.blog.blog',['blogs'=>$blogs]);
    }
    public function showBlogDetail($id){
        // Đếm comment
        $countCmt = Comment::where('id_blog',$id)->count();
        $comments = Comment::with('children')->where('level',0)->where('id_blog',$id)->get();
        // dd($comments->toArray());
        // dd($id);
        $blog = Blog::findOrFail($id);
        // Tìm blog kế tiếp
        $next = Blog::where('id', '>', $id)->orderBy('id', 'asc')->first();
    
        // Tìm blog trước đó
        $previous = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();

        $blog = Blog::with('ratings')->find($id);

        // Đánh giá sẽ có sẵn qua mối quan hệ
        $ratings = $blog->ratings;
        $aveRating = $ratings->avg('rating_star');
        $aveRating = round($aveRating, 2);
        
        return view('frontend.blog.blog-detail',['blog'=>$blog, 'next' => $next, 'previous' => $previous, 'aveRating' => $aveRating, 'comments'=>$comments,'countCmt'=>$countCmt]);
    }
    public function updateRating(Request $request){
        $rating = Rating::firstOrNew(['id_blog' => $request->id_blog, 'id_user' => auth()->id()]);
        $rating->rating_star=$request->rating;
        $rating->save();
        return back()->with('success', 'Rating has been added/updated successfully.');
        // $rating->rating_star = $request->rating;
        // $rating->id_user = $request->id_user;
        // $rating->id_blog = $request->id_blog;
        // $rating->save();
        // $blog = $request->all();
        // dd($request->id_blog);
    }
}
