<?php

namespace App\Http\Controllers\Admin\Book;

use App\Http\Controllers\Admin\Book\Actions\ActionInterface;
use App\Http\Controllers\Admin\Book\Actions\StoreFileAction;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CrudController;
use App\Http\Requests\Admin\Book\StoreRequest;
use App\Http\Requests\Admin\Book\UpdateRequest;
use App\Models\Book;
use App\Models\Category;
use App\Services\CrudService\CrudInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BookController
{
    use CrudController;

    protected $path = 'Admin.';

    protected $model = Book::class;

    public const NUMBER = 10;

    private $action;

    protected $crudServiceInterface;

    public function __construct(StoreFileAction $action, CrudInterface $crudServiceInterface)
    {
        $this->action = $action;

        $this->crudServiceInterface = $crudServiceInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $model = $this->model::paginate(self::NUMBER);

        return view($this->getClassName('index'), compact('model'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $this->action->handle($request);

        $model = $this->crudServiceInterface->create($this->model, $data);

        $model->categories()->sync($request->category_id);

        return redirect()->route('book.index')->with('success','Успешно');
    }

    public function update(UpdateRequest $request, Book $book): RedirectResponse
    {
        $data = $this->action->handle($request);

        $model = $this->crudServiceInterface->update($book, $data);

        $model->categories()->sync($request->category_id);

        return redirect()->route('book.index')->with('success','Успешно');
    }

    public function create(): View
    {
        $data = $this->getCategories();

        return view($this->getClassName('create'), compact('data'));
    }

    public function edit($id): View
    {
        $data = $this->getCategories();

        $model = $this->crudServiceInterface->read($this->model, $id);

        return view($this->getClassName('edit'), compact('model', 'data'));
    }

    public function destroy(Book $book): RedirectResponse
    {
        $this->deleteImage($book);

        $this->crudServiceInterface->delete($book);

        return redirect()->back()->with('success','Успешно');
    }

    private function deleteImage(Book $book): void
    {
        Storage::delete('public/covers/' . $book->cover);
        Storage::delete('public/storage/covers/' . $book->cover);
    }

    private function getCategories(): Collection
    {
        return Category::all();
    }

    public function show(Book $book): View
    {

        return view($this->getClassName('show'), compact('book'));
    }
}
