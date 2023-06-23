<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

//
        $posts = Post::all()->sortByDesc('created_at')->values();

        foreach ($posts as  $post) {
            $reaction = Reaction::where('user_id', Auth::id())->where('post_id', $post->id)->first();
            $post['reaction'] = $reaction;

            // Truy vấn tất cả các comments của bài đăng đó và lưu vào mảng $comments trong từng post tương ứng
            $comments = Comment::where('post_id', $post->id)->get();
            $post['comments'] = $comments;
        }

        return view('posts.index')->with([
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required', 'min:10']
        ]);

        $post = new Post();
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Post $post)
    // {

    // }
    public function show($id)
    {
        $post = Post::find($id);
        $comments = $post->comments;
        $tags = $post->tags;
        return view('posts.show')->with([
            'post' => $post,
            'comments' => $comments,
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)

    {
        $post = Post::find($id);
        $tags = Tag::all();

        return view('posts.edit')->with([
            'post' => $post,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $post = Post::find($id);
        if ($post->user_id == Auth::user()->id) {
            $post->title = $request->get('title');
            $post->content = $request->get('content');
            $post->save();
            $post->tags()->sync($request->get('tags'));
        }
        return redirect('/posts/' . $post->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $id =$request->get('post_id');
        $post = Post::find($id);
        if ($post->user_id == Auth::user()->id) {
            $post->delete();
        }
        return redirect('posts');

    }
}
