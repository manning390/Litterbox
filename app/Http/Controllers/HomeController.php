<?php

namespace App\Http\Controllers;

use Auth;
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
        $bumped = Thread::nsfwFilter()->bumped()->paginate();
        $new = Thread::nsfwFilter()->orderBy('created_at')->paginate();
        $pinned = Thread::pinned()->orderBy('created_at');

        return view('home', compact('bumped', 'new', 'pinned'));
    }

    public function tags()
    {
        $tags = Tag::all();
        return view('tags', compact('tags'));
    }

    public function about()
    {
        return view('about');
    }

    public function search(){
        return 'search ?';
    }

    public function dismiss(Announcement $announcement){
        $announcement->dismiss(Auth::user());
        return response()->json();
    }


}
