<?php

namespace App\Http\Controllers\Admin\Book\Actions;

use Illuminate\Http\Request;

interface ActionInterface
{
    public function handle(object $data);
}
