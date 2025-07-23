@extends('backend.layouts.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Products</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Products</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Products List</h4>
                                <a href="{{ route('products.create') }}" class="ms-auto">
                                    <button class="btn btn-primary btn-round">
                                        <i class="fa fa-plus"></i>
                                        Add product
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Features</th>
                                            <th>Price</th>
                                            <th>On Sale</th>
                                            <th>Original Price</th>
                                            <th>Discount Percentage</th>
                                            <th>Image</th>

                                            <th style="width: 10%">Action</th>
                                            <th>Created At</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                                </td>
                                                <td>{{ $product->title }}</td>
                                                <td>{!! $product->short_description !!}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>{!! $product->short_features !!}</td>
                                                <td>{{ $product->price }}</td>

                                                <!-- Display the sale status, original price, and discount percentage -->
                                                <td>
                                                    @if ($product->is_on_sale)
                                                        <span class="badge bg-success">On Sale</span>
                                                    @else
                                                        <span class="badge bg-secondary">Not on Sale</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($product->is_on_sale && $product->original_price)
                                                        <span
                                                            class="badge bg-info">${{ number_format($product->original_price, 2) }}</span>
                                                    @else
                                                        <span class="badge bg-black">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($product->discount_percentage)
                                                        <span
                                                            class="badge bg-warning">{{ $product->discount_percentage }}%</span>
                                                    @else
                                                        <span class="badge bg-black ">N/A</span>
                                                    @endif
                                                </td>

                                                <!-- Product Image -->
                                                <td>
                                                    <img src="{{ asset('storage/' . $product->main_image) }}"
                                                        alt="Product Image" width="100">
                                                </td>




                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('products.edit', $product->id) }}"
                                                            class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip"
                                                            title="Edit product">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form id="delete-form-{{ $product->id }}"
                                                            action="{{ route('products.delete', $product->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-link btn-danger"
                                                                data-bs-toggle="tooltip" title="Delete product"
                                                                onclick="confirmDelete({{ $product->id }})">
                                                                <i class="fa fa-times" style="color: #d33"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>{{ $product->formatted_created_at }}</td>
                                            </tr>
                                        @endforeach

                                        <div class="pagination-container">
                                            {{ $products->links('pagination::bootstrap-5') }}
                                        </div>

                                    </tbody>
                                </table>
                            </div>
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
