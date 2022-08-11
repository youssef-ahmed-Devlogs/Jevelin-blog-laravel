<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $articleId)
    {
        $comment = $request->all();
        $comment['user_id'] = Auth::id();
        $comment['article_id'] = +$articleId; // TODO: this + in order to converted to integer
        Comment::create($comment);
        return redirect()->back();
    }
}
