<?php

namespace App\Services;

use App\Filters\PostFilter;
use App\Filters\TagFilter;
use App\Http\Requests\Post\IndexPostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostService
{

    public function index(IndexPostRequest $request)
    {
        $filter = new PostFilter($request);

        return Post::filter($filter)->get();
    }


    public function view(Post $post)
    {
        return $post;
    }

    public function store($data)
    {
        DB::beginTransaction();
        $post = Post::create($data['data']);

        $user = Auth::user();

        $post->user()->associate($user);

        $post->save();

        foreach ($data['tags'] as $tagID){
            $tag = Tag::where('id',$tagID)->firstOrFail();
            $post->tags()->save($tag);

        }


        DB::commit();
        return $post;
    }

    public function update(Post $post, $data)
    {
        $post->update($data);
        $post->save();

        return $post;
    }

    public function delete(Post $post)
    {
        $post->delete();
    }

    public function bulk(Post $post, array $tagsIdArray)
    {
        DB::beginTransaction();
        $post->tags()->detach();

        foreach ($tagsIdArray['data'] as $item) {
            $tag = Tag::where('id', $item)->firstOrFail();
            $post->tags()->save($tag);
        }

        DB::commit();
        return $post->tags()->get();
    }
}
