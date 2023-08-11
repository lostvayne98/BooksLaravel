<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
       'is_favorite' => 'bool'
   ];


   protected $appends = [
       'is_favorite'
   ];

    protected function getCoverAttribute()
    {
        return asset('/storage/covers/' . $this->attributes['cover']);
    }

    public function getIsFavoriteAttribute()
    {
        if (auth()->check()) {
            return auth()->user()->isFavoriteBook($this->id);
        }

        return false; // Set a default value if the user is not authenticated
    }


    public function categories():BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
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
