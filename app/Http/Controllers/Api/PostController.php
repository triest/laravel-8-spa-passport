<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\BulkTagRequest;
use App\Http\Requests\Post\IndexPostRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Tag\TagResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    public PostService $postService;

    /**
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(IndexPostRequest $request)
    {
        $posts = $this->postService->index($request);

        return PostCollection::make($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = $this->postService->store($request->validated());

        return PostResource::make($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return PostResource::make($post);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post = $this->postService->update($post, $request->validated());

        return PostResource::make($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->postService->delete($post);

        return response()->setStatusCode(204);
    }

    /**
     * @param Post $post
     * @param BulkTagRequest $request
     * @return AnonymousResourceCollection
     */
    public function bulk(
        Post $post,
        BulkTagRequest $request
    ): \Illuminate\Http\Resources\Json\AnonymousResourceCollection {
        $tags = $this->postService->bulk($post, $request->validated());

        return TagResource::collection($tags);
    }
}
