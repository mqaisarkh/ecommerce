@extends('backend.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm mt-5">
                    <div class="card-header text-center">
                        <h5 class="card-title mb-0">Edit Product</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input name="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                    placeholder="Enter product title" value="{{ old('title', $product->title) }}" />
                                @error('title')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="category_id">Category</label>
                                <select name="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror form-select"
                                    id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                                <textarea name="description" class="form-control content @error('description') is-invalid @enderror" id="content"
                                    placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
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
                                    placeholder="Enter quantity" value="{{ old('quantity', $product->quantity) }}" />
                                @error('quantity')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="original_price">Original Price</label>
                                <input name="original_price" type="number"
                                    class="form-control @error('original_price') is-invalid @enderror" id="original_price"
                                    placeholder="Enter original price"
                                    value="{{ old('original_price', $product->original_price) }}" />
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
                                    placeholder="Enter price" value="{{ old('price', $product->price) }}" />
                                @error('price')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="discount_percentage">Discount Percentage</label>
                                <input name="discount_percentage" type="number"
                                    class="form-control  @error('discount_percentage') is-invalid @enderror"
                                    id="discount_percentage" placeholder="Enter discount percentage"
                                    value="{{ old('discount_percentage', $product->discount_percentage) }}" />
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
                                    <option value="1"
                                        {{ old('is_on_sale', $product->is_on_sale) == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0"
                                        {{ old('is_on_sale', $product->is_on_sale) == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('is_on_sale')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>





                            <div class="form-group mb-3">
                                <label for="features">Features</label>
                                <textarea name="features" class="form-control content @error('features') is-invalid @enderror" id="content"
                                    placeholder="Enter product features" rows="3">{{ old('features', $product->features) }}</textarea>
                                @error('features')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="form-group mb-3">
                                <label for="main_image">Product Image</label>
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
                                <input type="file" name="product_images[]" id="product_images" class="form-control" multiple >
                            </div>



                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-success me-2">Update</button>
                                <a href="{{ route('products.list') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                         <div class="row d-flex flex-wrap">
                                @foreach ($product->images as $image)
                                    <div class="col-md-3 mb-4 d-flex">
                                        <div class="card flex-fill">
                                            <img src="{{ asset('storage/' . $image->product_images) }}"
                                                class="card-img-top" alt="Product Image"
                                                style="object-fit: cover; height: 200px;">
                                            <div class="card-body text-center d-flex flex-column justify-content-between">

                                                <form id="delete-form-{{ $image->id }}"
                                                    action="{{ route('product.images.destroy', $image->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm"
                                                        style="background-color: #d33; color: white; border: none;"
                                                        data-bs-toggle="tooltip"
                                                        onclick="confirmDelete({{ $image->id }})">
                                                        Delete
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This product will be deleted permanently.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
    @endpush
@endsection

@include('backend.partials.tinymce')
