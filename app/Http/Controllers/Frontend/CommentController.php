<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function postComment($id, Request $request){
        $data = $request->validate([
            'comment' => 'required'
        ]);
        $data['id_user'] = Auth::id();
        $data['name_user'] = Auth::user()->name;
        $data['avatar_user'] = Auth::user()->avatar;
        $data['id_blog'] = $id;
        if($request->level != null){
            $data['level'] = $request->level;
        }
        toastr()->timeOut(1000)->success('Finshed Comment!!');

        // flash()->info('Finshed Comment!');
        // dd($data);
        $comment = Comment::create($data);
        return redirect()->back();
    }
    public function test(){
        return 'haha';
    }
}
