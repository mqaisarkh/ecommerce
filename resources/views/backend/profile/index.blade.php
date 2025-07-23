@extends('backend.layouts.main')

@section('content')
    <div class="main-content  mt-5">
        <div class="page-content ">
            <div class="container-fluid ">
                <div class="row ">
                    <div class="col-12 mt-5">
                        <div class=" py-1 page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Profile Management</h4>
                        </div>
                    </div>
                </div>
                @if (session('password_success'))
                    <div class="alert alert-success">
                        {{ session('password_success') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form action="{{ route('admin.profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <div class="text-center">
                                                <div class="avatar-xl mx-auto mb-4">
                                                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('backend/assets/img/profile.jpg') }}"
                                                        alt="Profile Picture" class="avatar-img rounded-circle">

                                                </div>
                                                <div class="mt-2">
                                                    <input type="file" class="form-control" id="profile_picture"
                                                        name="profile_picture">
                                                </div>
                                                <small class="text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="first_name" name="first_name"
                                                    value="{{ old('first_name', $user->first_name) }}" required>
                                                @error('first_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="last_name" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name"
                                                    value="{{ old('last_name', $user->last_name) }}" required>
                                                @error('last_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="tel" class="form-control" id="phone" name="phone"
                                                    value="{{ old('phone', $user->phone) }}" required>
                                                @error('phone')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ old('email', $user->email) }}" required>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Update Profile</button>
                                            </div>
                                        </div>
                                    </div>


                                </form>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 ">
                    <div class="  page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Update Password</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">


                                <form action="{{ route('admin.profile.update_password') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <div class="col-lg-3">

                                        </div>
                                        <div class="col-lg-9">
                                            <div class="mb-3">
                                                <label for="old_password" class="form-label">Current Password</label>
                                                <input type="password" class="form-control" id="old_password"
                                                    name="old_password" required>
                                                @error('old_password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="password" class="form-label">New Password</label>
                                                <input type="password" class="form-control" id="password" name="password"
                                                    required>
                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Confirm New
                                                    Password</label>
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    name="password_confirmation" required>
                                            </div>

                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Update Password</button>
                                            </div>
                                        </div>

                                    </div>


                                </form>


                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
