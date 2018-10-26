<?php

namespace App\Policies;

use App\Entities\User;
use App\Entities\Lending;
use Illuminate\Auth\Access\HandlesAuthorization;

class LendingPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $key
     * @param Lending $lending
     *
     * @return bool
     */
    public function before(User $user, $key, Lending $lending)
    {
        return $user->is_admin || $user->id === $lending->client->id;
    }

    /**
     * Determine whether the user can view the lending.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Lending  $lending
     * @return mixed
     */
    public function view(User $user, Lending $lending)
    {
        //
    }

    /**
     * Determine whether the user can create lendings.
     *
     * @param  \App\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the lending.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Lending  $lending
     * @return mixed
     */
    public function update(User $user, Lending $lending)
    {
        //
    }

    /**
     * Determine whether the user can delete the lending.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Lending  $lending
     * @return mixed
     */
    public function delete(User $user, Lending $lending)
    {
        //
    }

    /**
     * Determine whether the user can restore the lending.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Lending  $lending
     * @return mixed
     */
    public function restore(User $user, Lending $lending)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the lending.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Lending  $lending
     * @return mixed
     */
    public function forceDelete(User $user, Lending $lending)
    {
        //
    }
}
