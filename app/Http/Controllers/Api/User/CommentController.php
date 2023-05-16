<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Actions\UpdateRatingAction;
use App\Http\Requests\User\Comment\StoreRequest;
use App\Http\Requests\Api\Comment\UpdateRequest;
use App\Http\Resources\CommentResource;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentController extends Controller
{
    private $action;

    public function __construct(UpdateRatingAction $action)
    {
        $this->action = $action;
    }

    public function store(StoreRequest $request,Book $book):JsonResource
    {
        $comment = $book->comments()->create($request->validated());

        $this->action->handle($book);

        return new CommentResource($comment);
    }

    public function update(UpdateRequest $request,Comment $comment):JsonResource
    {
        if ($comment->user_id == auth()->id()) {

            $comment->update($request->validated());

            $this->action->handle($comment->book);
        }

        return new CommentResource($comment);
    }

    public function show(Comment $comment):JsonResource
    {
        return new CommentResource($comment);
    }

    public function destroy(Comment $comment):JsonResponse
    {
        if (auth()->id() === $comment->user_id) {

            $comment->delete();

            return response()->json([
                'comment deleted'
            ]);
        }

        return response()->json([
            'comment not deleted'
        ],500);
    }
}
