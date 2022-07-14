<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AiboComment;

class AiboCommentController extends Controller
{
    public function store(Request $request)
    {
        $inputs=request()->validate([
            'aibo_comment_body'=>'required',
        ],
        //エラーメッセージ
        [
            'aibo_comment_body.required' => "コメントは必ず指定してください。",
        ]);

        $comment= new AiboComment();

        $comment->aibo_id = $request->aibo_id;
        $comment->owner_id = auth()->user()->owner->id;
        $comment->aibo_comment_body = $inputs['aibo_comment_body'];
        
        $comment->save();
        return back();
    }
}
