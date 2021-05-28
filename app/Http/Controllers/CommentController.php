<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('comment_body'); // galis a requesti body- in
        $comment->user()->associate($request->user()); // user avelcnum a auth exats user_id -in
        $post = Post::find($request->get('post_id')); // gtnum a mer uxarkats id -in
        $post->comments()->save($comment); // save a anum posti comments -i funkcian

        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();
        $reply->body = $request->get('comment_body'); // galis a requesti body- in
        $reply->user()->associate($request->user()); // user avelcnum a auth exats user_id -in
        $reply->parent_id = $request->get('comment_id'); // gtnum a te vor parent-i id in a u save
        $post = Post::find($request->get('post_id')); // te vor post_id in a

        $post->comments()->save($reply);

        return back();

    }
}
