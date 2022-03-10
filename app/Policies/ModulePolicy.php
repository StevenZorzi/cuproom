<?php

namespace App\Policies;

use App\User;
use App\Models\Core\Module;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModulePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the module.
     *
     * @param  \App\User  $user
     * @param  App\Models\Core\Module  $module
     * @return mixed
     */
    public function view(User $user, Module $module)
    {
   
        return in_array($user->role, $module->roles) && $module->active == '1';
    }

    /**
     * Determine whether the user can create modules.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the module.
     *
     * @param  \App\User  $user
     * @param  App\Models\Core\Module  $module
     * @return mixed
     */
    public function update(User $user, Module $module)
    {
        //
    }

    /**
     * Determine whether the user can delete the module.
     *
     * @param  \App\User  $user
     * @param  \App\Module  $module
     * @return mixed
     */
    public function delete(User $user, Module $module)
    {
        //
    }
}
