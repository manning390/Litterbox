<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{

    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
    }

    public function show($username){
        $user = User::where('name', $username)->firstOrFail();
        return view('user.show', compact('user'));
    }

    public function edit(){
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function update(UpdateUserProfileRequest $request){
        $attributes = collect($request->only('profile'))->put('options', $request->except('profile'));
        Auth::user()->update($attributes);
        return redirect()->route('user.edit');
    }
}
