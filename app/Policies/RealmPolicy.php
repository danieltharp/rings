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
     * Determine whether the user can view the realm.
     *
     * @param  App\Account  $user
     * @param  App\Realm  $realm
     * @return mixed
     */
    public function view(Account $user)
    {
        $level = DB::connection('auth')->table('account_access')->where([
            ['id', '=', $user->id],
            ['gmlevel', '=', 3],
        ])->count();

        return $level;
    }

    /**
     * Determine whether the user can create realms.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the realm.
     *
     * @param  App\User  $user
     * @param  App\Realm  $realm
     * @return mixed
     */
    public function update(User $user, Realm $realm)
    {
        //
    }

    /**
     * Determine whether the user can delete the realm.
     *
     * @param  App\User  $user
     * @param  App\Realm  $realm
     * @return mixed
     */
    public function delete(User $user, Realm $realm)
    {
        //
    }
}
