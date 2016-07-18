<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Announcement;
use App\Http\Requests;

class AdminController extends Controller
{
    public function index(){
        return view('admin.home');
    }

    public function assume(User $user){
        if(Auth::user()->cannot('assume_user')) abort(403);

        Auth::login($user);

        return redirect()->route('home')->flash('success', "You've successfully stolen the identity of $user->name.");
    }

    public function announce(){
        return view('admin.announce');
    }

    public function storeAnnounce(Request $request){
        if(Auth::user()->cannot('make_annoucement')) abort(403);

        $this->validate($request, [
            'name' => 'required|max:255',
            'body' => 'required'
        ]);

        Annoucement::create($request->all())
            ->associate(Auth::user())
            ->announce();

        return redirect()->route('admin.announce')->flash('success', 'Annoucement has been created.');
    }
}
