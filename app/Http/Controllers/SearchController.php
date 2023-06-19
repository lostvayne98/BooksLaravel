<?php

namespace App\Http\Controllers;

use App\Services\Search\QueryBuilderFactory;
use App\Services\Search\QueryBuilderFactoryInterface;
use App\Services\Search\Strategy\BookBuilderStrategy;
use App\Services\Search\Strategy\UserBuilderStrategy;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $factory;

    public function __construct(QueryBuilderFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function index(Request $request)
    {
        $filter = array_filter($request->all());
        if ($request->has('search')) {
            $results = collect([
                'books' => $this->factory->createBookQueryBuilder($filter, new BookBuilderStrategy())->build(),
                'users' => $this->factory->createUserQueryBuilder($filter, new UserBuilderStrategy())->build(),
            ]);
        } else {
            $results = collect();
        }


        return view('User.Search.index', compact('results'));
    }
}
