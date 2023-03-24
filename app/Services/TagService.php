<?php

namespace App\Services;


use App\Filters\TagFilter;
use App\Http\Requests\Tag\IndexTagRequest;
use App\Models\Tag;

class TagService
{

    public function index(IndexTagRequest $request)
    {
        $filter = new TagFilter($request);

        return Tag::filter($filter)->get();
    }


    public function view(Tag $tag)
    {
        return $tag;
    }

    public function store($data)
    {
        $post = Tag::create($data);

        return $post;
    }

    public function update(Tag $tag, $data)
    {
        $tag->update($data);

        return $tag;
    }

    public function delete(Tag $tag)
    {
        $tag->delete();
    }
}
