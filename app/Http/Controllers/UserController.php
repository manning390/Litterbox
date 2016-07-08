<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function show($username){
        $user = User::where('name', $username)->firstOrFail();
        return view('user.show', compact('user'));
    }

    public function edit(){
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function update(Response $response){
        dd($response);
    }
}
