<?php

declare(strict_types=1);

namespace App\Services\Search;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface QueryBuilder
{

    /**
     * @return array|Builder|Collection
     */
    public function build();
}
