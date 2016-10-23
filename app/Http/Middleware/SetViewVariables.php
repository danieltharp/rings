<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Illuminate\Support\Facades\View;
use App\Realm;
use Illuminate\Support\Facades\DB;

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
        view()->share('user', $user);

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
        View::share('realms', $realms);
        View::share('active', Realm::find(session('realm')));
        return $next($request);
    }
}
