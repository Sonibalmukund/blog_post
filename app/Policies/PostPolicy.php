<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, Post $post)
    {
        // Check if the user is an admin or the author of the post
        return $user->isAdmin() || $user->id === $post->user_id;
    }
}
