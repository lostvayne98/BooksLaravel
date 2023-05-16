<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\RedirectResponse;

class CommentPolicy
{
    use HandlesAuthorization;



    public function createComment(User $user)
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateComment(User $user, Comment $comment):bool
    {
        return $comment->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteComment(User $user, Comment $comment):Response
    {
        return $comment->user_id === $user->id
            ? Response::allow()
            : Response::deny('Вы можете удалять только свои комментарии') ;
    }


}
