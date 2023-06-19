<?php

declare(strict_types=1);

namespace App\Services\Search\Strategy;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserBuilderStrategy implements QueryBuilderStrategy
{

    public function buildQuery(array $request): Builder
    {
        return User::query()->where('name', 'LIKE', '%' . $request['search'] . '%');
    }
}
