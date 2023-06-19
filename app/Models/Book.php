<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'description',
        'title',
        'cover',
        'slug',
        'rating',
        'price',
    ];

   /* protected $hidden = [
        'id'
    ];*/

   protected $casts = [
       'created_at' => 'date:d:m:Y',
       'updated_at' => 'date:d:m:Y',
   ];



    public function categories():BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments():HasMany
    {
        return $this->hasMany(Comment::class,'book_id','id');
    }

    public function updateRating()
    {
        $numberOfRatings = $this->comments()->count();

        if ($numberOfRatings > 0) {
            $totalRating = $this->comments()->sum('rating');
            $newRating = $totalRating / $numberOfRatings;
        } else {
            $newRating = 0;
        }
        $this->rating = $newRating;

        $this->save();
    }

}
