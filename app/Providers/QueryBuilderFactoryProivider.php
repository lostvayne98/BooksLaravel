<?php

namespace App\Providers;

use App\Services\Search\QueryBuilderFactory;
use App\Services\Search\QueryBuilderFactoryInterface;
use Illuminate\Support\ServiceProvider;

class QueryBuilderFactoryProivider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(QueryBuilderFactoryInterface::class,QueryBuilderFactory::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
