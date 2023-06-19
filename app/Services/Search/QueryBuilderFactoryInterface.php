<?php

declare(strict_types=1);

namespace App\Services\Search;

use App\Services\Search\Strategy\QueryBuilderStrategy;

interface QueryBuilderFactoryInterface
{
    public function createBookQueryBuilder(array $params,QueryBuilderStrategy $strategy): QueryBuilder;
    public function createUserQueryBuilder(array $params,QueryBuilderStrategy $strategy): QueryBuilder;
}
