<?php

namespace App\Http\Controllers\User\Actions;

use App\Http\Controllers\Admin\Book\Actions\ActionInterface;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;

class UpdateRatingAction implements ActionInterface
{
    public function handle(object $model):void
    {
        $numberOfRatings = $model->comments()->count();

        if ($numberOfRatings > 0) {
            $totalRating = $model->comments()->sum('rating');
            $newRating = $totalRating / $numberOfRatings;
        } else {
            $newRating = 0;
        }
        $model->rating = $newRating;

        $model->save();

    }
}
