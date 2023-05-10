@extends('layouts.main')
@section('content')
    <div>
        <form action="{{ route('post.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input value="{{ old('title') }}" type="text" name="title" class="form-control" id="title"
                       placeholder="Title">
                @error('title')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <label for="content" class="form-label">Content</label>
                <textarea name="content" class="form-control" id="content"
                          placeholder="Content">{{ old('content') }}</textarea>
                @error('content')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <label for="image" class="form-label">Image</label>
                <input value="{{ old('image') }}" type="text" name="image" class="form-control" id="image"
                       placeholder="Image">
                @error('image')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category_id" aria-label="Default select example">
                    @foreach($categories as $category)
                        <option
                            {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                <div class="form-group mt-3">

                    <label for="tags">Tags</label>
                    <select class="form-select" multiple id="tags" name="tags[]" aria-label="multiple select example">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>

@endsection
