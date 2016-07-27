<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Thread;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bumped = Thread::bumped()->paginate();
        $new = Thread::orderBy('created_at')->paginate();
        return view('home', compact('bumped', 'new'));
    }

    public function tags()
    {
        $tags = Tag::all();
        return view('tags', compact('tags'));
    }

    public function dismiss(Announcement $announcement){
        $announcement->dismiss();
        return response()->json();
    }
}
