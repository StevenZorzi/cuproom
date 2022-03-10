<?php

namespace App\Policies;

use App\User;
use App\Models\Portfolio\Portfolio;
use Illuminate\Auth\Access\HandlesAuthorization;

class PortfolioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the portfolio.
     *
     * @param  \App\User  $user
     * @param  \App\Portfolio  $portfolio
     * @return mixed
     */
    public function view(User $user, Portfolio $portfolio)
    {
        //
    }

    /**
     * Determine whether the user can create portfolios.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the portfolio.
     *
     * @param  \App\User  $user
     * @param  \App\Portfolio  $portfolio
     * @return mixed
     */
    public function update(User $user, Portfolio $portfolio)
    {
        //
    }

    /**
     * Determine whether the user can delete the portfolio.
     *
     * @param  \App\User  $user
     * @param  \App\Portfolio  $portfolio
     * @return mixed
     */
    public function delete(User $user, Portfolio $portfolio)
    {
        //
    }
}
