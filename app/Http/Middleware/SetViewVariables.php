<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Illuminate\Support\Facades\View;
use App\Realm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Database;

class SetViewVariables
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        $user = $this->auth->user();
        if (session('realm') == null) { session(['realm' => 1]); }
        $auth = DB::connection('auth');
        $realms = Realm::with('uptime')->get();
        foreach ($realms as $realm) {
            $realm->diff = new \Carbon\Carbon();
            $realm->diff = $realm->diff->createFromTimestamp($realm->uptime->last()->starttime)->toDayDateTimeString();
            if ($user) {
                $realm->numchars = $auth->table('realmcharacters')->where([
                    ['realmid', '=', $realm->id],
                    ['acctid', '=', $user->id],
                ])->value('numchars');
            }
            else { $realm->numchars = 0; }
        }
        if($user) {
            $cconn = Database::where([
                ['realmid', '=', session('realm')],
                ['type', '=', 'c']
            ])->first();
            Config::set('database.connections.character.host', $cconn->address);
            Config::set('database.connections.character.port', $cconn->port);
            Config::set('database.connections.character.database', $cconn->name);
            Config::set('database.connections.character.username', $cconn->username);
            Config::set('database.connections.character.password', $cconn->password);
            $connection = DB::reconnect('character');
            $chars = $connection->table('characters')->where('account', $user->id)->get();
            foreach ($chars as $char) {
                switch($char->race) {
                    case 1:
                        $char->race = "Human"; #TODO: i18n
                        break;
                    case 2:
                        $char->race = "Orc";
                        break;
                    case 3:
                        $char->race = "Dwarf";
                        break;
                    case 4:
                        $char->race = "Night Elf";
                        break;
                    case 5:
                        $char->race = "Undead";
                        break;
                    case 6:
                        $char->race = "Tauren";
                        break;
                    case 7:
                        $char->race = "Gnome";
                        break;
                    case 8:
                        $char->race = "Troll";
                        break;
                    case 9:
                        $char->race = "Goblin";
                        break;
                    case 10:
                        $char->race = "Blood Elf";
                        break;
                    case 11:
                        $char->race = "Draenei";
                        break;
                    case 22:
                        $char->race = "Worgen";
                        break;
                    case 24:
                    case 25:
                    case 26:
                        $char->race = "Pandaren";
                        break;
                }
                switch($char->class) {
                    case 1:
                        $char->class = "Warrior";
                        break;
                    case 2:
                        $char->class = "Paladin";
                        break;
                    case 3:
                        $char->class = "Hunter";
                        break;
                    case 4:
                        $char->class = "Rogue";
                        break;
                    case 5:
                        $char->class = "Priest";
                        break;
                    case 6:
                        $char->class = "Death Knight";
                        break;
                    case 7:
                        $char->class = "Shaman";
                        break;
                    case 8:
                        $char->class = "Mage";
                        break;
                    case 9:
                        $char->class = "Warlock";
                        break;
                    case 10:
                        $char->class = "Monk";
                        break;
                    case 11:
                        $char->class = "Druid";
                        break;
                }
                switch($char->gender) {
                    case 0:
                        $char->gender = "Male";
                        break;
                    case 1:
                        $char->gender = "Female";
                        break;
                }
            }
        } else { $chars = null; }

        View::share('realms', $realms);
        View::share('active', Realm::find(session('realm')));
        View::share('chars', $chars);
        View::share('user', $user);

        return $next($request);
    }
}
