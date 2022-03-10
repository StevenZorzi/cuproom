<?php

namespace App\Policies;

use App\User;
use App\Models\ContactRequests\ContactRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactRequestPolicy
{
    use HandlesAuthorization;


    
    /**
     * Determine whether the user can view the contactRequest.
     *
     * @param  \App\User  $user
     * @param  \App\ContactRequest  $contactRequest
     * @return mixed
     */
    public function view(User $user, ContactRequest $contactRequest)
    {
        //
    }

    /**
     * Determine whether the user can create contactRequests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the contactRequest.
     *
     * @param  \App\User  $user
     * @param  \App\ContactRequest  $contactRequest
     * @return mixed
     */
    public function update(User $user, ContactRequest $contactRequest)
    {
        //
    }

    /**
     * Determine whether the user can delete the contactRequest.
     *
     * @param  \App\User  $user
     * @param  \App\ContactRequest  $contactRequest
     * @return mixed
     */
    public function delete(User $user, ContactRequest $contactRequest)
    {
        //
    }
}
