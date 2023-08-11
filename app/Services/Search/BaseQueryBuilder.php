<?php

declare(strict_types=1);

namespace App\Services\Search;

use \Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseQueryBuilder implements QueryBuilder
{

    /**
     * @var array
     */
    protected $request;

    /**
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }


    /**
     * @return array|Builder|Collection
     */
    public function build()
    {
        return $this->getQuery()->get()->toArray();
    }

    /**
     * @return Builder
     */
    protected abstract function getQuery():Builder;
}
