@extends('admin.Layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-8 offset-3 mt-5">
                        <div class="col-md-9">
                            <a href="{{ route('admin.admin_list') }}"><button class="btn btn-dark mb-1"> <i
                                        class="fa fa-arrow-left" aria-hidden="true"></i></button></a>
                            <div class="card">
                                <div class="card-header p-2">
                                    <legend class="text-center">Edit Role</legend>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <form class="form-horizontal" method="POST"
                                                action="{{ route('admin.update_admin', $userData->id) }}">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" disabled
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="inputName" name='name' value="{{ $userData->name }}"
                                                            placeholder="Name">
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" disabled
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="inputEmail" name="email" value="{{ $userData->email }}"
                                                            placeholder="Email">
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Phone</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" disabled
                                                            class="form-control @error('phone') is-invalid @enderror"
                                                            id="inputName" name="phone" value="{{ $userData->phone }}"
                                                            placeholder="phone number">
                                                        @error('phone')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Address</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" disabled
                                                            class="form-control @error('address') is-invalid @enderror"
                                                            id="inputName" name="address" value="{{ $userData->address }}"
                                                            placeholder="address">
                                                        @error('address')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName"
                                                        class="col-sm-2 col-form-label @error('role') is-invalid @enderror">Role
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <select name="role" class="form-select" id="">
                                                            @if ($userData->role == 'admin')
                                                                <option selected value="admin">Admin</option>
                                                                <option value="user">User</option>
                                                            @else
                                                                <option value="admin">Admin</option>
                                                                <option value="user" selected>User</option>
                                                            @endif
                                                        </select> @error('publish')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div cla <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" class="btn bg-dark text-white">Update</button>
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
            </div>
    </div>
    </section>
    </div>
@endsection
