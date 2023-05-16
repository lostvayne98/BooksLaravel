<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return  [
            'author' => $this->author,
            'description' => $this->description,
            'title' => $this->title ,
            'cover' => $this->cover,
            'slug' => $this->slug ,
            'rating' => $this->rating,
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'categories' => $this->categories
        ];
    }
}
