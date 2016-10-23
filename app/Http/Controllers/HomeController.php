<?php

namespace App\Http\Controllers;
use App\Database;
use Illuminate\Http\Request;
use App\Realm;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Cloner\Data;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $active = Realm::where('id', session('realm') or 1)->first();
        $wconn = Database::where([
            ['realmid', '=', $active->id],
            ['type', '=', 'w']
        ])->first();
        Config::set('database.connections.character.host', $wconn->address);
        Config::set('database.connections.character.port', $wconn->port);
        Config::set('database.connections.character.database', $wconn->name);
        Config::set('database.connections.character.username', $wconn->username);
        Config::set('database.connections.character.password', $wconn->password);
        $world = DB::reconnect('world');

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = Realm::find(session('realm'));
        $cconn = Database::where([
            ['realmid', '=', $active->id],
            ['type', '=', 'c']
        ])->first();
        Config::set('database.connections.character.host', $cconn->address);
        Config::set('database.connections.character.port', $cconn->port);
        Config::set('database.connections.character.database', $cconn->name);
        Config::set('database.connections.character.username', $cconn->username);
        Config::set('database.connections.character.password', $cconn->password);
        $char = DB::reconnect('character');
        $chars = $char->table('characters')->where('account', Auth::user()->id)->get();
        return view('home', compact('chars'));
    }
}
