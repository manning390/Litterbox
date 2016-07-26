<?php

namespace App\Http\Controllers\Admin;

use App\Flag;
use App\Enums\FlagType;
use App\Enums\FlagStatusType;
use App\Http\Controllers\Controller;

class FlagController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->middleware('can:manage_flags', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $flags = Flag::with(['post', 'post.thread', 'user'])->orderBy('type')->get()->groupBy('status');
        $types = collect(FlagType::getKeys())->flip();
        $statuses = collect(FlagStatusType::getKeys())->flip();
        return view('admin.flag.index', compact('flags', 'types', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Flag   $flag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flag $flag){
        dd($request);
    }
}