<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;

class StoreController extends BaseController
{
   public function __invoke(FilterRequest $request)
   {
       $data = $request->validated();

       $post = $this->service->store($data);

       return new PostResource($post);

       //return redirect()->route('post.index');
   }
}

