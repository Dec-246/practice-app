<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IdeaPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Idea $idea): bool
    {
        // using Response with 'access' in the path.
        // this line means we get 404 NOT FOUND instead of 403 NOT AUTHORISED
        //return $user->id == $idea->user_id ? Response::allow() : Response::denyAsNotFound();

        // authorising the user signed in that created the idea
        return $user->is($idea->user);
    }

    /**
     * Determine whether the user can create the model.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }
}
