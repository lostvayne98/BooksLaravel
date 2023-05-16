<?php

namespace App\Http\Controllers;




trait CrudController
{

    public function getClassName(string $action): string
    {
        $className = class_basename($this->model);


        $viewPath = str_replace('\\', '.', $className);


        return $this->path . sprintf('%s.%s', $viewPath, $action);
    }

}
