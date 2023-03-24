<?php

namespace App\Http\Resources\Post;

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
                    'title' => $item->name,
                    'user' => $item->user ? UserResource::make($item->user) : null,
                ];
            }),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
