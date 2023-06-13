<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Book\Actions\ActionInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\User\Actions\UpdateRatingAction;
use App\Http\Requests\User\Comment\StoreRequest;
use App\Http\Requests\User\Comment\UpdateRequest;
use App\Models\Book;
use App\Models\Comment;
use App\Services\CrudService\CrudInterface;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CommentController extends Controller
{
    use CrudController;

    protected $model = Comment::class;

    protected $path = 'User.';

    private $action;

    private $crudServiceInterface;


    public function __construct(UpdateRatingAction $action,CrudInterface $crudServiceInterface)
    {
        $this->action = $action;
        $this->crudServiceInterface = $crudServiceInterface;
    }


    public function create(Book $book)
    {
        return view($this->getClassName('create'),compact('book'));
    }

    public function store(StoreRequest $request, Book $book): RedirectResponse
    {
        $book->comments()->create($request->validated());

        $this->action->handle($book);

        return redirect()->back()->with('success','Успешно');
    }

    public function edit(Comment $comment):View
    {
        return view($this->getClassName('edit'),compact('comment'));
    }

    public function update(UpdateRequest $request, Comment $comment): RedirectResponse
    {
        $this->crudServiceInterface->update($comment, $request->validated());

        $this->action->handle($comment->book);

        return redirect()->route('user.book.index')->with('success','Успешно');
    }


    public function destroy(Comment $comment): RedirectResponse
    {
        $this->authorize('delete',$comment);
        $this->crudServiceInterface->delete($comment);

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }


}
