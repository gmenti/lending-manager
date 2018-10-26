<?php

namespace App\Policies;

use App\Entities\User;
use App\Entities\Installment;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstallmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the installment.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Installment  $installment
     * @return mixed
     */
    public function view(User $user, Installment $installment)
    {
        return $user->is_admin || $installment->lending->client->user_id;
    }

    /**
     * Determine whether the user can create installments.
     *
     * @param  \App\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the installment.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Installment  $installment
     * @return mixed
     */
    public function update(User $user, Installment $installment)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the installment.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Installment  $installment
     * @return mixed
     */
    public function delete(User $user, Installment $installment)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the installment.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Installment  $installment
     * @return mixed
     */
    public function restore(User $user, Installment $installment)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the installment.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Installment  $installment
     * @return mixed
     */
    public function forceDelete(User $user, Installment $installment)
    {
        return false;
    }
}
