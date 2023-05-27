<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CrudController;
use App\Models\Book;
use App\Services\CrudService\CrudInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController
{
    use CrudController;

    protected $path = 'User.';

    protected $model = Book::class;

    public const NUMBER = 10;

    private $crudServiceInterface;

    public function __construct(CrudInterface $crudServiceInterface)
    {
        $this->crudServiceInterface = $crudServiceInterface;
    }

    public function index(): View
    {
        $model = $this->model::query()->with('comments')->withCount('comments')->paginate(self::NUMBER);

        return view($this->getClassName('index'), compact('model'));
    }

    public function show(Book $book):View
    {
        return view($this->getClassName('show'),compact('book'));
    }
}
