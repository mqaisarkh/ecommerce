@extends('backend.layouts.main')

@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card shadow-sm mt-5">
                    <div class="card-header text-center">
                        <h5 class="card-title mb-0">Create New User</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-6 ">
                                    <label for="first_name">First Name</label>
                                    <input name="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                                        placeholder="Enter User First Name" value="{{ old('first_name') }}" />
                                    @error('first_name')
                                        <span><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label for="last_name">Last Name</label>
                                    <input name="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                        placeholder="Enter User Last Name" value="{{ old('last_name') }}" />
                                    @error('last_name')
                                        <span><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 ">
                                    <label for="email">Email Address</label>
                                    <input name="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="Enter Email Address" value="{{ old('email') }}" />
                                    @error('email')
                                        <span><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class=" form-group col-md-6  ">
                                        <label for="phone">Phone Number</label>
                                        <input class="form-control @error('phone') is-invalid @enderror " type="text"
                                            id="phone" required name="phone" value="{{ old('phone') }}">

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>


                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 ">
                                    <label for="password">Password</label>
                                    <input name="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        placeholder="Enter Password" />
                                    @error('password')
                                        <span><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input name="password_confirmation" type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" placeholder="Confirm Password" />
                                    @error('password_confirmation')
                                        <span><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 ">
                                    <label for="is_admin">User Role</label>
                                    <select class="form-select @error('is_admin') is-invalid @enderror" name="is_admin"
                                        id="is_admin">
                                        <option value="1" {{ old('is_admin') == '1' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="0" {{ old('is_admin') == '0' ? 'selected' : '' }}>User</option>
                                    </select>
                                    @error('is_admin')
                                        <span><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="status">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status"
                                        id="status">

                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                    </select>
                                    @error('status')
                                        <span><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 mb-2">
                                    <label for="profile_picture">User Image</label>
                                    <input type="file" name="profile_picture"
                                        class="form-control @error('profile_picture') is-invalid @enderror"
                                        id="profile_picture" />
                                    @error('profile_picture')
                                        <span><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success me-2">Submit</button>
                                <a href="{{ route('users.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
