@extends('backend.layouts.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Orders</h3>
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
                        <a href="#">Orders</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Orders List</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order ID</th>
                                            <th>User</th>
                                            <th>Total</th>
                                            <th>Items</th>
                                            <th>status</th>
                                            <th>Shipping Address</th>

                                            {{-- <th style="width: 10%">Action</th> --}}
                                            <th>Created At</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}
                                                </td>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                                <td>${{ $order->total }}</td>
                                                <td>
                                                    <ul>
                                                        @foreach ($order->items as $item)
                                                            <li>{{ $item->title }} (x{{ $item->quantity }}) -
                                                                ${{ $item->price }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>{{ $order->order_status }}</td>
                                                <td>
                                                    @if ($order->shippingAddress)
                                                        {{ $order->shippingAddress->first_name }}
                                                        {{ $order->shippingAddress->last_name }}<br>
                                                        {{ $order->shippingAddress->address }},
                                                        {{ $order->shippingAddress->city }}<br>
                                                        {{ $order->shippingAddress->state }},
                                                        {{ $order->shippingAddress->country }}<br>
                                                        {{ $order->shippingAddress->phone }} |
                                                        {{ $order->shippingAddress->email }}
                                                    @else
                                                        <em>No address</em>
                                                    @endif
                                                </td>






                                                <td>{{ $order->formatted_created_at }}</td>
                                            </tr>
                                        @endforeach

                                        <div class="pagination-container">
                                            {{ $orders->links('pagination::bootstrap-5') }}
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
@endsection


{{-- <td>
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
                                                </td> --}}
