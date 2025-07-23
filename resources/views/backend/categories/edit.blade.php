@extends('backend.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card shadow-sm mt-5">
                <div class="card-header text-center">
                    <h5 class="card-title mb-0">Edit Form Elements</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input name="name" type="text" class="form-control  @error('name') is-invalid @enderror"
                                id="name" value="{{ old('name', $category->name) }}" placeholder="Name" />
                            @error('name')
                                <span>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control content  @error('description') is-invalid @enderror" id="content"
                                placeholder="Enter Description">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <span>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label>Status</label>
                            <select class="form-select mb-4" name="status">
                                <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Active
                                </option>
                                <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success me-2">Update</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('backend.partials.tinymce')
