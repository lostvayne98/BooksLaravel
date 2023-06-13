<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BooksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'author' => $this->author,
            'description' => $this->description,
            'title' => $this->title,
            'cover' => $this->cover,
            'slug' => $this->slug,
            'rating' => $this->rating,
            'comments_count' => $this->when($this->comments_count, $this->comments_count),
        ];
    }
}
