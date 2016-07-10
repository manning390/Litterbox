<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Post $post){
        return $user->owns($post) || $user->hasPermission('edit_forum');
    }

    public function update(User $user, Post $post){
        return $user->owns($post) || $user->hasPermission('edit_forum');
    }

    public function destroy(User $user, Post $post){
        return $user->owns($post) || $user->hasPermission('delete_forum');
    }

}