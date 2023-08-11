<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slugges',
    ];

    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at',
        'id',
    ];

    public function books():BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }
}
