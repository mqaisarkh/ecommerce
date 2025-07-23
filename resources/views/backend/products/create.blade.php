@extends('backend.layouts.main')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            @if ($errors->any())
                <div class="alert alert-danger">
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
                        <h5 class="card-title mb-0">Create Product</h5>
                    </div>
                    <div class="card-body">
                        {{-- <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input name="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                    placeholder="Enter product title" value="{{ old('title') }}" />
                                @error('title')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="category_id">Category</label>
                                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror"
                                    id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                    placeholder="Enter product description">{{ old('description') }}</textarea>
                                @error('description')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="quantity">Quantity</label>
                                <input name="quantity" type="number"
                                    class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                                    placeholder="Enter quantity" value="{{ old('quantity') }}" />
                                @error('quantity')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">Price</label>
                                <input name="price" type="number"
                                    class="form-control @error('price') is-invalid @enderror" id="price"
                                    placeholder="Enter price" value="{{ old('price') }}" />
                                @error('price')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="features">Features</label>
                                <textarea name="features" class="form-control @error('features') is-invalid @enderror" id="features"
                                    placeholder="features" rows="3">{{ old('features') }}</textarea>
                                @error('features')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="images">Product Images</label>
                                <input type="file" name="images"
                                    class="form-control @error('images') is-invalid @enderror" id="images" />
                                @error('images')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-success me-2">Submit</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </div>
                        </form> --}}
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input name="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                    placeholder="Enter product title" value="{{ old('title') }}" />
                                @error('title')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="category_id">Category</label>
                                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror"
                                    id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control content @error('description') is-invalid @enderror" id="content">{{ old('description') }}</textarea>

                                @error('description')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="quantity">Quantity</label>
                                <input name="quantity" type="number"
                                    class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                                    placeholder="Enter quantity" value="{{ old('quantity') }}" />
                                @error('quantity')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="original_price">Original Price</label>
                                <input name="original_price" type="number" step="0.01"
                                    class="form-control @error('original_price') is-invalid @enderror" id="original_price"
                                    placeholder="Enter original price" value="{{ old('original_price') }}" />
                                @error('original_price')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="price">Price</label>
                                <input name="price" type="number"
                                    class="form-control @error('price') is-invalid @enderror" id="price"
                                    placeholder="Enter price" value="{{ old('price') }}" />
                                @error('price')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="discount_percentage">Discount Percentage</label>
                                <input name="discount_percentage" type="number" min="0" max="100"
                                    class="form-control @error('discount_percentage') is-invalid @enderror"
                                    id="discount_percentage" placeholder="Enter discount percentage"
                                    value="{{ old('discount_percentage') }}" />
                                @error('discount_percentage')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="is_on_sale">Is On Sale?</label>
                                <select name="is_on_sale" class="form-control @error('is_on_sale') is-invalid @enderror"
                                    id="is_on_sale">
                                    <option value="1" {{ old('is_on_sale') == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('is_on_sale') == '0' ? 'selected' : '' }}>No</option>
                                </select>
                                @error('is_on_sale')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="features">Features</label>
                                <textarea name="features" class="form-control content @error('features') is-invalid @enderror" id="feature"
                                    placeholder="Enter product features" rows="3">{{ old('features') }}</textarea>
                                @error('features')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="main_image">Product Main Images</label>
                                <input type="file" name="main_image"
                                    class="form-control @error('main_image') is-invalid @enderror" id="main_image" />
                                @error('main_image')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="product_images">Gallery</label>
                                <input type="file" name="product_images[]" id="product_images" class="form-control"
                                    multiple required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success me-2">Submit</button>
                                <a href="{{ route('products.list') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('backend.partials.tinymce')
