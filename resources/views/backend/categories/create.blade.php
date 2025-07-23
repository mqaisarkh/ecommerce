@extends('backend.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

                <div class="card shadow-sm mt-5">
                    <div class="card-header text-center">
                        <h5 class="card-title mb-0">Create Category</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="name">Name</label>
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" />

                                @error('name')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group mb-2">
                                <label for="description">Description</label>
                                <textarea name="description" type="text" class="form-control content @error('description') is-invalid @enderror" id="content" placeholder="Enter Description" ></textarea>
                                @error('description')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label>Status</label>
                                <select class="form-select mb-4" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success me-2">Submit</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

        </div>
    </div>
@endsection


@include('backend.partials.tinymce')
