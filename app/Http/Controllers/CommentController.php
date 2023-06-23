<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Rfc4122\Validator;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $postId = $request->get('post_id');
        $post = Post::find($postId);
        $comment = new Comment($request->all());
        $comment->user_id = Auth::user()->id;
        $post->comments()->save($comment);
        return $comment;


    }






    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $post = Post::find($id);
        $comment = Comment::find($id);
        if ($comment->user_id == Auth::user()->id) {
            $comment->content = $request->get('content');
            $comment->save();
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $comment = Comment::find($id);
        if ($comment->user_id == Auth::user()->id) {
            $comment->delete();
        }

        return redirect()->back();
    }
}
