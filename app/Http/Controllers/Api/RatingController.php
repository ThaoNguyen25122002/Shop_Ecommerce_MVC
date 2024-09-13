<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    //
    public function index(){
        $ratings = Rating::all();
        return response()->json(['ratings'=>$ratings],200);
    }
    public function updateRating($id, Request $request){
        $ratings = Rating::findOrFail($id);
        $ratings->update($request->rating_star);
        return response()->json(['massage'=>"Update finished!!"],201);
    }

    public function createRating($id, Request $request){
        $ratings = Rating::findOrFail($id);
        $ratings->update($request->rating_star);
        return response()->json(['massage'=>"Update finished!!"],201);
    }

    public function destroy($id)
    {
        $id_user = auth()->id();
        $rating = Rating::findOrFail($id);
        $id_user_rating = $rating->id_user;
        if ($id_user !== $id_user_rating) {
            return response()->json(['message' => 'Comment không thuộc Account này!'], 403);
        }
        $rating->delete();
        return response()->json(['message' => 'Xóa thành công!'], 200);
    }

}
