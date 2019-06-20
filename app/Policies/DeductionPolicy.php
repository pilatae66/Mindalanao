<?php

namespace App\Policies;

use App\User;
use App\Deduction;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeductionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the deduction.
     *
     * @param  \App\User  $user
     * @param  \App\Deduction  $deduction
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->role == 'HRO';
    }

    /**
     * Determine whether the user can create deductions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 'HRO';
    }

    /**
     * Determine whether the user can update the deduction.
     *
     * @param  \App\User  $user
     * @param  \App\Deduction  $deduction
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->role == 'HRO';
    }

    /**
     * Determine whether the user can delete the deduction.
     *
     * @param  \App\User  $user
     * @param  \App\Deduction  $deduction
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->role == 'HRO';
    }

    /**
     * Determine whether the user can restore the deduction.
     *
     * @param  \App\User  $user
     * @param  \App\Deduction  $deduction
     * @return mixed
     */
    public function restore(User $user, Deduction $deduction)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the deduction.
     *
     * @param  \App\User  $user
     * @param  \App\Deduction  $deduction
     * @return mixed
     */
    public function forceDelete(User $user, Deduction $deduction)
    {
        //
    }
}
