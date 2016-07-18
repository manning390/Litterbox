<?php

namespace App\Policies;

use App\User;
use App\Thread;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Thread $thread){
        return $user->owns($thread) || $user->can('edit_forum');
    }

    public function update(User $user, Thread $thread){
        return $user->owns($thread) || $user->can('edit_forum');
    }

    public function destroy(User $user, Thread $thread){
        return $user->owns($thread) || $user->can('delete_forum');
    }

    public function restore(User $user, Thread $thread){
        return $user->can('delete_forum');
    }

    public function pin(User $user, Thread $thread){
        return $user->can('pin_forum');
    }

    public function lock(User $user, Thread $thread){
        return $user->owns($post) || $user->can('lock_forum');
    }

    public function block(User $user, Thread $thread){
        return $user->can('block_forum');
    }
}
