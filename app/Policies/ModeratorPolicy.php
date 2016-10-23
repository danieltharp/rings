<?php

namespace App\Policies;

use App\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModeratorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user is a GM.
     *
     * @param  App\Account $user
     * @return mixed
     */
    public function authorize(Account $user)
    {
        $level = DB::connection('auth')->table('account_access')->where([
            ['id', '=', $user->id],
            ['gmlevel', '>=', 1],
        ])->count();

        return $level;
    }
}