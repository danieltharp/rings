<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Realm;
use App\Http\Requests;
use App\Database;

class RealmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $realms = Realm::all();
        return view('admin.realms.index', compact('realms'));
    }

    public function edit($realmid)
    {
        $realm = Realm::find($realmid);
        $ws = $realm->databases()->where('type', 'w')->first();
        $cs = $realm->databases()->where('type', 'c')->first();
        return view('admin.realms.edit', compact('realm', 'ws', 'cs'));
    }

    public function update(Request $request)
    {
        $input = $request->all();
        if($request->newdb) { // We're adding a new database.
            $newdb = Database::create([
                'realmid' => $request->newdb,
                'address' => $request->address,
                'port' => $request->port,
                'name' => $request->name,
                'username' => $request->username,
                'password' => $request->password,
                'type' => $request->type,
            ]);
            $newdb->saveOrFail();
            session()->flash('status', 'New database saved.');
        }
        else { // We're editing an existing database.

            $existingdb = Database::find($request->id)->first();

            $existingdb->address = $request->address;
            $existingdb->port = $request->port;
            $existingdb->name = $request->name;
            $existingdb->username = $request->username;
            $existingdb->password = $request->password;

            $existingdb->saveorFail();
            session()->flash('status', 'Database updated successfully.');
        }
        return redirect()->back();
    }
}
