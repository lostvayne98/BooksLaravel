<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\StoreRequest;
use App\Models\User;
use App\Services\CrudService\CrudInterface;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $crudServiceInterface;

    public function __construct(CrudInterface $crudServiceInterface)
    {
        $this->crudServiceInterface = $crudServiceInterface;
    }

    public function __invoke(StoreRequest $request,User $user)
    {
       $user = $this->crudServiceInterface->create($user,$request->validated());

       $token = $user->createToken('api-token')->accessToken;

       return response()->json([
          'token' => $token
       ]);
    }
}
