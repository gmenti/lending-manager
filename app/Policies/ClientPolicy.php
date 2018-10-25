<?php

namespace App\Policies;

use App\Entities\User;
use App\Entities\Client;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $key
     * @param Client $client
     *
     * @return bool
     */
    public function before(User $user, $key, Client $client)
    {
        return $user->id === $client->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can view the client.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Client  $client
     * @return mixed
     */
    public function view(User $user, Client $client)
    {
        //
    }

    /**
     * Determine whether the user can create clients.
     *
     * @param  \App\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the client.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Client  $client
     * @return mixed
     */
    public function update(User $user, Client $client)
    {
        //
    }

    /**
     * Determine whether the user can delete the client.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Client  $client
     * @return mixed
     */
    public function delete(User $user, Client $client)
    {
        //
    }

    /**
     * Determine whether the user can restore the client.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Client  $client
     * @return mixed
     */
    public function restore(User $user, Client $client)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the client.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Client  $client
     * @return mixed
     */
    public function forceDelete(User $user, Client $client)
    {
        //
    }
}
