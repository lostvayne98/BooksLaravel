<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\BooksResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookController extends Controller
{
    private $model = Book::class;

    private const NUMBER = 10;

    public function index(): JsonResource
    {
        $book = $this->model::paginate(self::NUMBER);

        return BooksResource::collection($book);
    }

    public function show(Book $book)
    {
        $book->load('comments');

        return new BookResource($book);
    }
}
