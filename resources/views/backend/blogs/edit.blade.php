@extends('backend.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="col-md-8">
                <div class="card shadow-sm mt-5">
                    <div class="card-header text-center">
                        <h5 class="card-title mb-0">Edit Blog</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Title --}}
                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input name="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title', $blog->title) }}" placeholder="Enter blog title">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div class="form-group mb-3">
                                <label for="category_id">Category</label>
                                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Body --}}
                            <div class="form-group mb-3">
                                <label for="body">Body</label>
                                <textarea name="body" class="form-control content @error('body') is-invalid @enderror" id="content">{{ old('body', $blog->body) }}</textarea>
                                @error('body')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Featured --}}

                            <div class="form-group mb-3">
                                <label for="featured">Featured</label>
                                <select name="featured" class="form-control @error('featured') is-invalid @enderror"
                                    id="featured">
                                    <option value="1"
                                        {{ old('featured', $blog->featured) == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0"
                                        {{ old('featured', $blog->featured) == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('featured')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Image --}}
                            <div class="form-group mb-3">
                                <label for="image">Blog Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                @if ($blog->image)
                                    <small class="d-block mt-1">Current Image:</small>
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" width="120" class="mt-2">
                                @endif
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-success me-2">Update</button>
                                <a href="{{ route('blogs.list') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
