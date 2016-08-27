<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Ban;
use App\Action;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bans = Ban::all();
        return view('admin.ban.index', compact('bans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ban.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Format all those affected by the ban
        $bannables = is_arary($request->bannable)? $request->bannable : [$request->bannable];

        // Find all those affected by the ban and apply the ban
        foreach($bannables as $bannable)
            Ban::apply($bannable, $request->type, $request->reason, $request->expires);

        return redirect()->route('admin.ban.show', [$ban])->flash('success', "Ban has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ban  $ban
     * @return \Illuminate\Http\Response
     */
    public function show(Ban $ban)
    {
        return view('admin.ban.show', compact('ban'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ban  $ban
     * @return \Illuminate\Http\Response
     */
    public function edit(Ban $Ban)
    {
        return view('admin.ban.edit', compact('ban'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ban  $ban
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ban $ban)
    {
        // $ban->expires = $request->expires ?? null;
        // // Format all those affected by the ban
        // $bannables = is_arary($request->bannable)? $request->bannable : [$request->bannable];
        // // Find all those affected by the ban and apply the ban
        // foreach($bannables as $bannable){
        //     $bannable = BanType::$morphMap[$request->type]::findOrFail($bannable);
        //     $bannable->bans()->save($ban);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ban  $ban
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ban $Ban)
    {
        $ban->delete();
        return redirect()->route('admin.ban.index')->flash('success', 'Ban has been successfully lifted.');
    }
}
