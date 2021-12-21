<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\records;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        
    }
    public function delete(records $user, Post $post)
    {
        return $user->id === $post->records_id;
    }
}
