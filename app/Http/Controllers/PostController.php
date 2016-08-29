<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Http\Requests;
use App\Enums\PointType;

class PostController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $this->authorize();
        $post = Post::create($request->all())->associateUser(Auth::user());
        return redirect()->route('thread.show', [$post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return redirect($post->permalink);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize($post);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize($post);
        $post->update($request->all());
        return redirect()->route('post.show', [$post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize($post);
        $post->delete();
        return redirect()->route('thread.show', [$post->thread]);
    }

    /**
     * Flag the Post
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post    $post
     * @return \Illuminate\Http\Response
     */
    public function flag(Request $request, Post $post){
        $this->validate($request, [
            'type' => 'required|enum:FlagType',
            'body' => 'max:300'
        ]);
        $post->flag($request->all());
        return redirect()->route('post.show', [$post])->flash('success', 'Post has been successfully flagged.');
    }
}
