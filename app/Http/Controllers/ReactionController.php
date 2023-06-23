<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReactionRequest;
use App\Http\Requests\UpdateReactionRequest;
use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReactionController extends Controller
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
    public function store (Request $request)
    {
        $post = Post::find($request->get('post_id'));
        $reaction = Reaction::where ('user_id', Auth::id())->where('post_id', $request->get('post_id'))->first();
        if($reaction==null) {
            $reaction = new Reaction();
            $reaction->post_id = $request->get('post_id');
            $reaction->user_id = Auth::id();
            $reaction->save();
            return ["action" => 'liked',"reaction"=> $reaction, 'count'=> $post->reactions->count() ];
        }else{
            $reaction->delete();
            return ["action"=> 'unlike','count'=> $post->reactions->count()];
        }

//        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Reaction $reaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reaction $reaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReactionRequest $request, Reaction $reaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reaction $reaction)
    {
        //
    }
}
