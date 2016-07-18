<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    public function index(){
        return view('admin.home');
    }

    public function announce(){
        return view('admin.announce');
    }

    public function storeAnnounce(Request $request){

    }
}
