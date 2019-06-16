<?php

namespace App\Policies;

use App\User;
use App\Leave;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeavePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the leave.
     *
     * @param  \App\User  $user
     * @param  \App\Leave  $leave
     * @return mixed
     */
    public function view(User $user, Leave $leave)
    {
        //
    }

    /**
     * Determine whether the user can create leaves.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role->first()->name == 'Admin' || $user->role->first()->name == 'HRO';
    }

    /**
     * Determine whether the user can update the leave.
     *
     * @param  \App\User  $user
     * @param  \App\Leave  $leave
     * @return mixed
     */
    public function update(User $user, Leave $leave)
    {
        return $user->role->first()->name == 'Admin' || $user->role->first()->name == 'HRO';
    }

    /**
     * Determine whether the user can delete the leave.
     *
     * @param  \App\User  $user
     * @param  \App\Leave  $leave
     * @return mixed
     */
    public function delete(User $user, Leave $leave)
    {
        return $user->role->first()->name == 'Admin' || $user->role->first()->name == 'HRO';
    }

    /**
     * Determine whether the user can restore the leave.
     *
     * @param  \App\User  $user
     * @param  \App\Leave  $leave
     * @return mixed
     */
    public function restore(User $user, Leave $leave)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the leave.
     *
     * @param  \App\User  $user
     * @param  \App\Leave  $leave
     * @return mixed
     */
    public function forceDelete(User $user, Leave $leave)
    {
        //
    }
}
