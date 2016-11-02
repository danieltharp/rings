<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Http\Requests;
use App\Realm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $allAnnouncements = Announcement::where('realm_id', session('realm'))->orWhere('realm_id', -1)->get();
        return view('announcements.index', compact('allAnnouncements'));
    }

    public function add()
    {
        $realms = Realm::all();
        return view('announcements.add', compact('realms'));
    }

    public function create(Request $request)
    {
        $announcement = new Announcement;

        $announcement->account_id = Auth::user()->id;
        $announcement->realm_id = $request->realm_id;
        $announcement->title = $request->title;
        $announcement->body = $request->body;
        $announcement->saveOrFail();
        session()->flash('status', 'Announcement created successfully.');
        return redirect()->to('/gm/announce');
    }

    public function edit($announcement)
    {
        $announce = Announcement::findOrFail($announcement);
        return view('announcements.edit', compact('announce'));
    }

    public function update(Request $request)
    {
        $ann = Announcement::find($request->announcement);
        if($request->realm_id == -1) {
            if(Auth::user()->can('GlobalGM', Realm::find(session('realm')))) {
                $ann->title = $request->title;
                $ann->body = $request->body;
                $ann->realm_id = -1;
                $ann->account_id = Auth::user()->id;
                $ann->saveOrFail();
                session()->flash('status', 'Announcement edited successfully.');
                return redirect()->to('/gm/announce');
            }
            else { abort(403); }
        }
        else {
            if (Auth::user()->can('GM', Realm::find($request->realm_id))) {
                $ann->title = $request->title;
                $ann->body = $request->body;
                $ann->realm_id = $request->realm_id;
                $ann->account_id = Auth::user()->id;
                $ann->saveOrFail();
                session()->flash('status', 'Announcement edited successfully.');
                return redirect()->to('/gm/announce');
            }
            else { abort(403); }
        }

    }

    public function confirmDelete($announcement)
    {
        $ann = Announcement::find($announcement);
        if($ann->realm_id == -1) {
            if(Auth::user()->can('GlobalGM', Realm::find(session('realm')))) {
                return view('announcements.confirmdelete', compact('ann'));
            }
            else { abort(403); }
        }
        else {
            if (Auth::user()->can('GM', Realm::find($ann->realm_id))) {
                return view('announcements.confirmdelete', compact('ann'));
            }
            else { abort(403); }
        }
    }

    public function delete($announcement)
    {
        $ann = Announcement::find($announcement);
        if($ann->realm_id == -1) {
            if(Auth::user()->can('GlobalGM', Realm::find(session('realm')))) {
                $ann->delete();
                session()->flash('status', 'Announcement deleted successfully.');
                return redirect()->to('/gm/announce');
            }
            else { abort(403); }
        }
        else {
            if (Auth::user()->can('GM', Realm::find($ann->realm_id))) {
                $ann->delete();
                session()->flash('status', 'Announcement deleted successfully.');
                return redirect()->to('/gm/announce');
            }
            else { abort(403); }
        }
    }
}
