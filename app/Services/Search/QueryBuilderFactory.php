<?php

declare(strict_types=1);

namespace App\Services\Search;

use App\Services\Search\Book\BookQueryBuilder;
use App\Services\Search\Strategy\QueryBuilderStrategy;
use App\Services\Search\User\UserQueryBuilder;

class QueryBuilderFactory implements QueryBuilderFactoryInterface
{


    public function createBookQueryBuilder(array $params,QueryBuilderStrategy $strategy): QueryBuilder
    {
        return new BookQueryBuilder($params,$strategy);
    }

    public function createUserQueryBuilder(array $params,QueryBuilderStrategy $strategy): QueryBuilder
    {
        return new UserQueryBuilder($params,$strategy);
    }
}
