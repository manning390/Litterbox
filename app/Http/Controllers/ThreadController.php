<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;
use App\Posts;
use App\Thread;
use App\Http\Requests;
use App\Enums\SyntaxType;

class ThreadController extends Controller
{

    public function __construct(){
        parent::__construct();
        $this->middleware('auth', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $syntaxes = collect(SyntaxType::getKeys())->flip();
        return view('thread.create', compact('syntaxes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreThreadRequest $request)
    {
        $thread = Thread::create($request);
        $thread->tags()->saveMany(Tag::firstOrCreateMany($request->tags));
        Auth::user()->threads()->save($thread);
        Auth::user()->posts()->save($thread->posts()->first());
        return redirect()->route('thread.show', [$thread]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        $posts = $thread->rootPosts()->paginate();
        $syntaxes = collect(SyntaxType::getKeys())->flip();
        return view('thread.show', compact('thread', 'posts', 'syntaxes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        $this->authorize($thread);
        return view('thread.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateThreadRequest $request, Thread $thread)
    {
        $this->authorize($thread);
        $thread->update($request);
        return redirect()->route('thread.show', [$thread]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        $this->authorize($thread);
        $thread->delete();
        return redirect()->route('home');
    }

    /**
     * Restore the specified resource in storage.
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function restore(Thread $thread)
    {
        $this->authorize($thread);
        $thread->restore();
        return redirect()->route('thread.show', [$thread]);
    }

    /**
     * Toggle the current like state of the thread.
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function like(Thread $thread)
    {
        $thread->toggleLike();
        return redirect()->route('home');
    }

    /**
     * Toggle the current pin state of the thread.
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function pin(Thread $thread)
    {
        $this->authorize($thread);
        $thread->togglePin();
        return redirect()->route('home');
    }

    /**
     * Toggle the current lock state of the thread
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function lock(Thread $thread)
    {
        $this->authorize($thread);
        $thread->toggleLock();
        return redirect()->route('thread.show', [$thread]);
    }

    /**
     * Toggle the current block state of the thread.
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function block(Thread $thread)
    {
        $this->authorize($thread);
        $this->toggleBlock();
        return redirect()->route('thread.show', [$thread]);
    }
}
