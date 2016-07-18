<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Announcement;
use App\Http\Requests;

class AdminController extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->middleware('can:make_annoucement', ['only'=>['announce', 'storeAnnounce']]);
    }
    public function index(){
        return view('admin.home');
    }

    public function announce(){
        return view('admin.announce');
    }

    public function storeAnnounce(Request $request){
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
