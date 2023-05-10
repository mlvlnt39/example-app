<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }


    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required | string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post = Post::create($data);

        $post->tags()->attach($tags);

        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);
        return redirect()->route('post.show', $post->id);
    }

    public function delete(Post $post)
    {
        $post = Post::withTrashed()->find(2);
        $post->restore();
        dd('post deleted');
    }

    protected function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

    public function firstOrCreate()
    {

        $anotherPost = [
            'title' => 'some post',
            'content' => 'some content',
            'image' => 'some image12lorem.jpg',
            'likes' => 50000,
            'is_published' => 1,
        ];

        $post = Post::firstOrCreate([
            'title' => 'some title phpstorm',
        ], [
            'title' => 'some title phpstorm',
            'content' => 'some content',
            'image' => 'some image12lorem.jpg',
            'likes' => 50000,
            'is_published' => 1,
        ]);
        dump($post->content);
        dd('finished');
    }

    public function updateOrCreate()
    {
        /* $anotherPost = [
             'title' => 'update or create some post',
             'content' => 'update or create some content',
             'image' => 'update or create some image12lorem.jpg',
             'likes' => 500,
             'is_published' => 0,
         ];
         */
        $post = Post::updateOrCreate([
            'title' => 'some title not phpstorm'
        ], [
            'title' => 'some title not phpstorm',
            'content' => 'not updated content',
            'image' => 'not updated image12lorem.jpg',
            'likes' => 500,
            'is_published' => 0,
        ]);
        dump($post->content);
        dd(131);
    }
}
