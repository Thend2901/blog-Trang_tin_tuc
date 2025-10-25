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
        return redirect("/")->with('message','Bài viết đã được tạo thành công');
    }
    public function(){

    };

}
