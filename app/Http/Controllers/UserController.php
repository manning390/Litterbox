<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(){
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
        $user = Auth::user();
        $attributes = collect($request->only('profile'))->put('options', $request->except(['avatar', 'profile']));
        dd($attributes);
        $user->update($attributes);

        $file = $request->file('avatar');
        if($file){ // File name won't change but the image extension can can
            $filename = $user->id .'.'. $file->getClientOriginalExtension();
            Storage::disk('public')->put(User::$avatarPath . $filename);
            $user->avatar = $filename;
            $user->save();
        }
        return redirect()->route('user.edit');
    }
}
