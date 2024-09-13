<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    //
    public function index($id){
        $comments = Comment::with('children')->where('id_blog',$id)->where('level',0)->get();
        return response()->json(['comments'=>$comments],200);
    }

    public function createComment($id, Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'comment' => 'required|max:255',
        ]);
    
        // Kiểm tra nếu dữ liệu không hợp lệ
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Lấy dữ liệu đã được xác thực
        $validatedData = $validator->validated();
    
        // Tạo comment mới
        $comment = Comment::create([
            'id_user' => Auth::id(),
            'name_user' => Auth::user()->name,
            'comment' => $validatedData['comment'],
            'avatar_user' => Auth::user()->avatar,
            'id_blog' => $id,
            'level' => $request->level
        ]);
    
        // Trả về phản hồi thành công
        return response()->json(['message' => 'Comment thành công'], 201);
    }

    public function updateComment($id, Request $request){
        $id_user = auth()->id();
        // dd($id);
        $comment = Comment::findOrFail($id);
        $id_comment_user = $comment->id_user;
        if($id_user !== $id_comment_user){
            return response()->json(['message'=> 'Không đủ quyền!'],403);
        }
        // $comment->update($request->comment);
        $comment->comment = $request->comment;
        $comment->save();
        // dd($request->comment);
        return response()->json(['massage'=>"Cập nhật thành công!!"],204);
    }

    public function destroy($id){
        // dd($id);
        $comment = Comment::findOrFail($id);
        $userId = auth()->id();
        if($comment->id_user !== $userId){
            return response()->json(['message'=>'Không đủ quyền!'],403);
        }
        $comment->delete();
        return response()->json(['message'=>'Delete Finished!!!'],200);
    }
}
