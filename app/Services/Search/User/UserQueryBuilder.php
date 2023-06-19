<?php

declare(strict_types=1);

namespace App\Services\Search\User;

use App\Models\User;
use App\Services\Search\BaseQueryBuilder;
use App\Services\Search\Strategy\QueryBuilderStrategy;
use \Illuminate\Database\Eloquent\Builder;

class UserQueryBuilder extends BaseQueryBuilder
{

    private $strategy;

    public function __construct(array $request,QueryBuilderStrategy $strategy)
    {
        parent::__construct($request);

        $this->strategy = $strategy;
    }

    protected function getQuery():Builder
    {
        return $this->strategy->buildQuery($this->request);
    }
}
