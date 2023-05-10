@extends('layouts.main')
@section('content')
    <h1>Posts</h1>

    <form method="get">
        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" name="id" class="form-control" value="{{ request('id') }}">
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ request('title') }}">
        </div>

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <hr>

    <div class="row">
        @foreach($posts as $post)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->body }}</p>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Show</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $posts->appends(request()->all())->links() }}
@endsection
{{--@section('content')--}}
{{--    <div>--}}
{{--        <div>--}}
{{--            <a href="{{ route('post.create') }}" class="btn btn-primary mb-3">Add one</a>--}}
{{--        </div>--}}
{{--        @foreach($posts as $post)--}}
{{--            <div><a href="{{ route('post.show', $post->id) }}">{{ $post->id }}. {{ $post->title }}</a></div>--}}
{{--        @endforeach--}}

{{--        <div>--}}
{{--            {{ $posts->withQueryString()->links() }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
