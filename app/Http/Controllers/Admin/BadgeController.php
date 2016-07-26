<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BadgeController extends Controller
{

    public function __construct(){
        parent::__construct();
        $this->middleware('can:manage_badges', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $badges = Badge::all();
        return view('badge.index', compact('badges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('badge.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBadgeRequest $request)
    {
        $file = $request->file('image');
        $extension = $file->getClinetOriginalExtension();

        $badge = new Badge;
        $badge->name = $request->input('name');
        $badge->label = $request->input('label') ?? realTitleCase($request->input('name'));
        $badge->save();

        $badge->update(['filename' => $file->getFilename().'.'.$extension]);

        Storage::disk('public')->put(Badge::$badgeDir . $badge->filename, File::get($file));

        return redirect()->route('badge.show', [$badge]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Badge $badge)
    {
        // return view('badge.show', [$badge]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Badge $badge)
    {
        // return view('badge.edit', compact('badge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Badge $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Badge $id)
    {
        //
    }
}
