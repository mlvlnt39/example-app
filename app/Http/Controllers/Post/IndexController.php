<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;


class IndexController extends BaseController
{
    public function index(Request $request)
    {
        $posts = Post::query();

        $data = $request;

        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;

        if ($request->has('id')) {
            $posts->where('id', $request->input('id'));
        }

        if ($request->has('title')) {
            $posts->where('title', 'like', '%' . $request->input('title') . '%');
        }

        $posts = $posts->paginate($perPage, ['*'], 'page', $page);

        return PostResource::collection($posts);

        //return view('post.index', compact('posts'));
    }

//   public function __invoke(FilterRequest $request)
//   {
//
//       $posts=Post::all();
////       $data = $request->validated();
////
////       $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
////       $posts = Post::filter($filter)->paginate(10);
//
//       return view('post.index', compact('posts'));
//   }
}
