<?php

namespace App\Policies;

use App\Account;
use App\Realm;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class RealmPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user is an Admin of the realm.
     *
     * @param  App\Account  $user
     * @param  App\Realm  $realm
     * @return mixed
     */
    public function Admin(Account $user, Realm $realm)
    {
        $level = DB::connection('auth')->table('account_access')->where([
            ['id', '=', $user->id],
            ['gmlevel', '=', 3],
            ['RealmID', '=', $realm->id],
        ])->orWhere([
            ['id', '=', $user->id],
            ['gmlevel', '>=', 3],
            ['RealmID', '=', -1]
        ])->count();

        return $level;
    }

    /**
     * Determine whether the user is a GM of the realm.
     *
     * @param  App\Account  $user
     * @param  App\Realm  $realm
     * @return mixed
     */
    public function GM(Account $user, Realm $realm)
    {
        $level = DB::connection('auth')->table('account_access')->where([
            ['id', '=', $user->id],
            ['gmlevel', '>=', 2],
            ['RealmID', '=', $realm->id],
        ])->orWhere([
            ['id', '=', $user->id],
            ['gmlevel', '>=', 3],
            ['RealmID', '=', -1]
        ])->count();

        return $level;
    }

    /**
     * Determine whether the user is a Moderator of the realm.
     *
     * @param  App\Account  $user
     * @param  App\Realm  $realm
     * @return mixed
     */
    public function Moderator(Account $user, Realm $realm)
    {
        $level = DB::connection('auth')->table('account_access')->where([
            ['id', '=', $user->id],
            ['gmlevel', '>=', 1],
            ['RealmID', '=', $realm->id],
        ])->orWhere([
            ['id', '=', $user->id],
            ['gmlevel', '>=', 3],
            ['RealmID', '=', -1]
        ])->count();

        return $level;
    }
}
