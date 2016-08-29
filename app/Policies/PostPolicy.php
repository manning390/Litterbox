<?php

namespace App\Policies;

use App\Post;
use App\User;
use App\Enums\BanType;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function store(User $user){
        return $user->banned(BanType::ThreadBan);
    }

    public function edit(User $user, Post $post){
        return ($user->owns($thread) && !$user->banned(BanType::ThreadBan) || $user->can('edit_forum');
    }

    public function update(User $user, Post $post){
        return ($user->owns($thread) && !$user->banned(BanType::ThreadBan) || $user->can('edit_forum');
    }

    public function destroy(User $user, Post $post){
        return ($user->owns($thread) && !$user->banned(BanType::ThreadBan) || $user->can('delete_forum');
    }

}
