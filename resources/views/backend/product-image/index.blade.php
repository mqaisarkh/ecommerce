@extends('backend.layouts.main')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Product Gallery</h2>

        <!-- Display Gallery Images -->
        <div style="margin-left: 15px;">
            <div class="row">

                <!-- Button to Add More Images -->
                <div class="mt-4">
                    <h4 class="ml-3">Add More Images</h4>
                    <form action="{{ route('product.images.store', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="images[]" id="images" class="form-control" multiple required>
                        </div>
                        <button type="submit" class="btn btn-primary ml-3 mb-2">Upload Images</button>
                    </form>
                </div>

                <div class="row d-flex flex-wrap">
                    @foreach ($product->images as $image)
                        <div class="col-md-3 mb-4 d-flex">
                            <div class="card flex-fill">
                                <img src="{{ asset('storage/' . $image->product_images) }}" class="card-img-top"
                                    alt="Product Image" style="object-fit: cover; height: 200px;">
                                <div class="card-body text-center d-flex flex-column justify-content-between">

                                    <form id="delete-form-{{ $image->id }}"
                                        action="{{ route('product.images.destroy', $image->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #d33; color: white; border: none;"
                                            data-bs-toggle="tooltip" onclick="confirmDelete({{ $image->id }})">
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
