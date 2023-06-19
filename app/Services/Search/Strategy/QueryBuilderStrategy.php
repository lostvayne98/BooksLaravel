<?php

declare(strict_types=1);

namespace App\Services\Search\Strategy;

use Illuminate\Database\Eloquent\Builder;

interface QueryBuilderStrategy
{
    public function buildQuery(array $request):Builder;
}
