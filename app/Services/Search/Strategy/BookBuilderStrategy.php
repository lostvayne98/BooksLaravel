<?php

declare(strict_types=1);

namespace App\Services\Search\Strategy;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;

class BookBuilderStrategy implements QueryBuilderStrategy
{

    public function buildQuery(array $request): Builder
    {
        return Book::query()->when(isset($request['price_start']), function ($q) use($request) {
            $q->whereBetween('price', [$request['price_start'], $request['price_end']]);
        })->when(isset($request['search']), function ($q) use($request) {
            $q->where(function ($query) use($request) {
                $query->where('title', 'LIKE', '%' . $request['search'] . '%')
                    ->orWhere('description', 'LIKE', '%' . $request['search'] . '%')
                    ->orWhereHas('comments', function ($q) use($request) {
                        $q->where('title', 'LIKE', '%' . $request['search'] . '%')
                            ->orWhere('description', 'LIKE', '%' . $request['search'] . '%');
                    })
                    ->orWhereHas('categories', function ($q) use($request) {
                        $q->where('title', 'LIKE', '%' . $request['search'] . '%');
                    });
            })->with('categories');
        });
    }
}
