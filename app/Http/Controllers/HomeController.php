<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Post;
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
        return view('home', compact('bumped', 'new'));
    }
}
