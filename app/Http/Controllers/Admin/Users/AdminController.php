<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CrudController;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Mail\NotifyAdmin;
use App\Models\User;
use App\Services\CrudService\CrudInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AdminController
{
    use CrudController;

    protected $model = User::class;

    protected $path = 'Admin.';

    public const NUMBER = 10;

    private $crudServiceInterface;

    public function __construct(CrudInterface $crudServiceInterface)
    {
        $this->crudServiceInterface = $crudServiceInterface;
    }

    public function index(): View
    {
        $model = $this->model::where('id', '!=', auth()->id())
            ->whereHas('roles')
            ->paginate(self::NUMBER);

        return view($this->getClassName('index'),compact('model'));
    }

    public function edit(User $user):View
    {
        return view($this->getClassName('update'),compact('user'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $model = $this->crudServiceInterface->create($this->model, $request->validated());

        $model->assignRole('admin');
        try {
            Mail::to($request->email)->to(new NotifyAdmin($model));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }



        return redirect()->route('users.index')->with('success','Успешно');
    }

    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $this->crudServiceInterface->update($user,$request->validated());

        return redirect()->route('users.index')->with('success','Успешно');
    }

    public function create():View
    {
        return view($this->getClassName('create'));
    }

    public function destroy(User $user):RedirectResponse
    {
        $this->crudServiceInterface->delete($user);

        return redirect()->back()->with('success','Успешно');
    }

    public function show(User $user):View
    {
        return view($this->getClassName('show'),compact('user'));
    }
}
