<?php

namespace App\Policies;

use App\User;
use App\Database;
use Illuminate\Auth\Access\HandlesAuthorization;

class DatabasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the database.
     *
     * @param  App\User  $user
     * @param  App\Database  $database
     * @return mixed
     */
    public function view(User $user, Database $database)
    {

    }

    /**
     * Determine whether the user can create databases.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the database.
     *
     * @param  App\User  $user
     * @param  App\Database  $database
     * @return mixed
     */
    public function update(User $user, Database $database)
    {
        //
    }

    /**
     * Determine whether the user can delete the database.
     *
     * @param  App\User  $user
     * @param  App\Database  $database
     * @return mixed
     */
    public function delete(User $user, Database $database)
    {
        //
    }
}
