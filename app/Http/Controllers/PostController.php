<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    public function createPost(Request $request){
        $fields = $request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);
        $fields['title']=strip_tags($fields['title']);
        $fields['body']=strip_tags($fields['body']);
        $fields['user_id']=auth()->id();
        Post::create($fields);
        // về trang chủ sau khi tạo bài viết
        return redirect("/")->with('message','Bài viết đã được tạo thành công');
    }
    public function destroy($id){
        $post=Post::fin($id);
        if($post !=null){
            $post->delete();
            return redirect("/")->with('message','Bài viết đã được xóa thành công');
        }
        else{
            return redirect("/")->with('message','Bài viết không tồn tại');
        }
    }
    public function showEditScreen(Post $post){
        if(auth()->user()->id==$post->user->id){
            return view('edit-post',['post'=>$post]);
        }
        else{
            return redirect("/")->with('message','Bạn không có quyền sửa bài viết này');
        }
    }
    public function updatePost(Request $request, Post $post){
        if(auth()->user()->id==$post->user->id){
            $fields = $request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);
            $fields['title']=strip_tags($fields['title']);
            $fields['body']=strip_tags($fields['body']);
            $post->update($fields);
            return redirect("/")->with('message','Bài viết đã được cập nhật thành công');

        }
        else{
            return redirect("/");
        }
    }
}
