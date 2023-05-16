<?php

namespace App\Providers;

use App\Http\Controllers\Admin\Book\Actions\ActionInterface;
use App\Http\Controllers\Admin\Book\Actions\StoreFileAction;
use App\Http\Controllers\User\Actions\UpdateRatingAction;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ActionInterface::class,StoreFileAction::class);
        $this->app->bind(ActionInterface::class,UpdateRatingAction::class);
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
