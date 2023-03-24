<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(/**
             */ function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'user' => $item->user ? UserResource::make($item->user) : null,
                    'tags' => $item->tags ? TagResource::collection($item->tags) : []
                ];
            }),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
