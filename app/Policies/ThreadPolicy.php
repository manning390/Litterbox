<?php

namespace App\Policies;

use App\User;
use App\Thread;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Thread $thread){
        return $user->owns($thread) || $user->hasPermission('edit_forum');
    }

    public function update(User $user, Thread $thread){
        return $user->owns($thread) || $user->hasPermission('edit_forum');
    }

    public function destroy(User $user, Thread $thread){
        return $user->owns($thread) || $user->hasPermission('delete_forum');
    }

    public function restore(User $user, Thread $thread){
        return $user->hasPermission('delete_forum');
    }

    public function pin(User $user, Thread $thread){
        return $user->hasPermission('pin_forum');
    }

    public function lock(User $user, Thread $thread){
        return $user->owns($post) || $user->hasPermission('lock_forum');
    }

    public function block(User $user, Thread $thread){
        return $user->hasPermission('block_forum');
    }
}
