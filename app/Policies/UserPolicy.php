<?php

namespace App\Policies;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $authUser, User $user)
    {
        return Gate::forUser($authUser)->allows('restricted-access') || $authUser->id == $user->id;
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $authUser)
    {
        return Gate::forUser($authUser)->allows('restricted-access');
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $authUser, User $user)
    {
        return Gate::forUser($authUser)->allows('restricted-access') || $authUser->id == $user->id;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $authUser, User $user)
    {
        return Gate::forUser($authUser)->allows('restricted-access') && $authUser->id != $user->id;
    }


    public function index(User $authUser)
    {
        return Gate::forUser($authUser)->allows('restricted-access');
    }

    public function access(User $authUser)
    {
        return Gate::forUser($authUser)->allows('admin-access');
    }
}
