<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexPostRequest;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
     *
     * @return PostCollection
     */
    public function index(IndexPostRequest $request): PostCollection
    {
        $posts = $this->postService->index($request);

        return PostCollection::make($posts);
    }



    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PostResource
     */
    public function show(Post $post): PostResource
    {
        $post = $this->postService->show($post);

        return PostResource::make($post);
    }


    /**
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return PostResource|Application|ResponseFactory|Response|object
     */
    public function update(UpdatePostRequest $request, Post $post): PostResource|Response|Application|ResponseFactory
    {
        if(!Auth::user()){
            return response()->setStatusCode(403);
        }

        $post = $this->postService->update($post, $request->validated());

        return PostResource::make($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post): Response
    {
        if(!Auth::user()){
            return response()->setStatusCode(403);
        }
        $this->postService->destroy($post);

        return \response()->setStatusCode(204);
    }
}
