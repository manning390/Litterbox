<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Thread;
use App\Http\Requests;

class SearchController extends Controller
{

    public function index(){

    }

    public function search(Request $request){
        $error = ['error' => 'No results found, please try with a different keyword.'];

        if($request->has('q')){
            $threads = Thread::search($request->get('q'))->get();

            return $posts->count() ? $posts : $error;
        }
        return $error;
    }
}
