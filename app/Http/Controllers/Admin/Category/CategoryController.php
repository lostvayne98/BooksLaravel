<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CrudController;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use App\Services\CrudService\CrudInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CategoryController
{
    use CrudController;

    protected $model = Category::class;

    protected $path = 'Admin.';

    public const NUMBER = 10;

    private $crudServiceInterface;

    public function __construct(CrudInterface $crudServiceInterface)
    {
        $this->crudServiceInterface = $crudServiceInterface;
    }

    public function index(): View
    {
        $model = $this->model::paginate(self::NUMBER);

        return view($this->getClassName('index'), compact('model'));
    }


    public function show($id): View
    {
        $model = $this->crudServiceInterface->read($this->model, $id);

        return view($this->getClassName('show'), compact('model'));
    }

    public function create(): View
    {
        return view($this->getClassName('create'));
    }

    public function edit($id): View
    {
        $model = $this->crudServiceInterface->read($this->model, $id);

        return view($this->getClassName('edit'), compact('model'));
    }


    public function destroy($id): RedirectResponse
    {
        $model = $this->crudServiceInterface->read($this->model, $id);

        $this->crudServiceInterface->delete($model);

        return redirect()->back()->with('success','Успешно');
    }

    public function store(StoreRequest $request):RedirectResponse
    {
        $this->crudServiceInterface->create($this->model,$request->validated());

        return redirect()->route('category.index')->with('success','Успешно');
    }

    public function update(UpdateRequest $request,Category $category):RedirectResponse
    {
        $this->crudServiceInterface->update($category,$request->validated());

        return redirect()->route('category.index')->with('success','Успешно');
    }
}
