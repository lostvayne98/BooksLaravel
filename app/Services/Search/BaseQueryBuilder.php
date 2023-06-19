<?php

declare(strict_types=1);

namespace App\Services\Search;

use \Illuminate\Database\Eloquent\Builder;

abstract class BaseQueryBuilder implements QueryBuilder
{

    protected $request;
    /**
     * @inheritDoc
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    /**
     * @inheritDoc
     */
    public function build()
    {
        return $this->getQuery()->get()->toArray();
    }

    protected abstract function getQuery():Builder;
}
