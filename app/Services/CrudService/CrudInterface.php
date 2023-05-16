<?php

namespace App\Services\CrudService;

use Illuminate\Database\Eloquent\Model;

interface CrudInterface
{
    public function create(string $model,array $data):Model;

    public function read(string $model,string $id):Model;

    public function update(object  $model,array $data):object;

    public function delete(object $model);


}
