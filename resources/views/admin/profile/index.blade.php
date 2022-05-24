@extends('admin.Layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-8 offset-3 mt-5">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <legend class="text-center">User Profile</legend>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <form class="form-horizontal" method="POST"
                                                action="{{ route('admin.update_profile', $userData->id) }}">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="inputName" name='name'
                                                            value="{{ old('name') ?? $userData->name }}"
                                                            placeholder="Name">
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="inputEmail" name="email"
                                                            value="{{ old('email') ?? $userData->email }}"
                                                            placeholder="Email">
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Phone</label>
                                                    <div class="col-sm-10">
                                                        <input type="number"
                                                            class="form-control @error('phone') is-invalid @enderror"
                                                            id="inputName" name="phone"
                                                            value="{{ old('phone') ?? $userData->phone }}"
                                                            placeholder="phone number">
                                                        @error('phone')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Address</label>
                                                    <div class="col-sm-10">
                                                        <input type="text"
                                                            class="form-control @error('address') is-invalid @enderror"
                                                            id="inputName" name="address"
                                                            value="{{ old('address') ?? $userData->address }}"
                                                            placeholder="address">
                                                        @error('address')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" class="btn bg-dark text-white">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <a href="{{ route('admin.change_password', $userData->id) }}"
                                                class="text-decoration-none">
                                                <p class="text-primary">Change Password</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
