@extends('admin.Layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-8 offset-3 mt-5">
                        <div class="col-md-9">
                            <a href="{{ route('admin.profile') }}"><button class="btn btn-dark mb-1"> <i
                                        class="fa fa-arrow-left" aria-hidden="true"></i></button></a>
                            <div class="card">
                                <div class="card-header p-2">
                                    <legend class="text-center">Change Password</legend>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        @if (Session::has('pwderror'))
                                            <div class="alert alert-danger alert-dismissible fade show my-2 mx-2"
                                                role="alert">
                                                {{ Session::get('pwderror') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if (Session::has('npwderror'))
                                            <div class="alert alert-danger alert-dismissible fade show my-2 mx-2"
                                                role="alert">
                                                {{ Session::get('npwderror') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if (Session::has('numpwderror'))
                                            <div class="alert alert-danger alert-dismissible fade show my-2 mx-2"
                                                role="alert">
                                                {{ Session::get('numpwderror') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <div class="active tab-pane" id="activity">
                                            <form action="{{ route('admin.update_password', Auth()->user()->id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Old
                                                        Password
                                                    </label>
                                                    <input type="password" name="oldPassword"
                                                        class="form-control @error('oldPassword') is-invalid @enderror"
                                                        id="exampleFormControlInput1">
                                                    @error('oldPassword')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">New
                                                        Password
                                                    </label>
                                                    <input type="password" name="newPassword"
                                                        class="form-control @error('newPassword') is-invalid @enderror"
                                                        id="exampleFormControlInput1">
                                                    @error('newPassword')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Comfirm
                                                        Password
                                                    </label>
                                                    <input type="password" name="comfirmPassword"
                                                        class="form-control @error('comfirmPassword') is-invalid @enderror"
                                                        id="exampleFormControlInput1">
                                                    @error('comfirmPassword')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <input type="submit" value="Change" class="btn btn-dark">
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
