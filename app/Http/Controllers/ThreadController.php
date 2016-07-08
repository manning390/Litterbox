<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Thread;
use App\Posts;
use App\Http\Requests;
use App\Enums\SyntaxType;

class ThreadController extends Controller
{
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
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thread = Thread::findOrFail($id);
        $posts = $thread->rootPosts()->paginate();
        $syntaxes = collect(SyntaxType::getKeys())->flip();
        return view('thread.show', compact('thread', 'posts', 'syntaxes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thread = Thread::findOrFail($id);
        $this->authorize($thread);
        return view('thread.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $thread = Thread::findOrFail($id);
        $this->authorize($thread);
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thread = Thread::findOrFail($id);
        $this->authorize($thread);
        $thread->delete();
        return redirect()->route('home');
    }

    /**
     * Restore the specified resource in storage.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $thread = Thread::findOrFail($id);
        $this->authorize($thread);
        $thread->restore();
        return redirect()->route('thread.show', [$thread]);
    }

    /**
     * Toggle the current like state of the thread.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function like($id)
    {
        $thread = Thread::findOrFail($id);
        $thread->toggleLike();
        return redirect()->route('home');
    }

    /**
     * Toggle the current pin state of the thread.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function pin($id)
    {
        $thread = Thread::findOrFail($id);
        $this->authorize($thread);
        $thread->togglePin();
        return redirect()->route('home');
    }

    /**
     * Toggle the current lock state of the thread
     * @param  pin $id
     * @return \Illuminate\Http\Response
     */
    public function lock($id)
    {
        $thread = Thread::findOrFail($id);
        $this->authorize($thread);
        $thread->toggleLock();
        return redirect()->route('thread.show', [$thread]);
    }

    /**
     * Toggle the current block state of the thread.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function block($id)
    {
        $thread = Thread::findOrFail($id);
        $this->authorize($thread);
        $this->toggleBlock();
        return redirect()->route('thread.show', [$thread]);
    }
}
