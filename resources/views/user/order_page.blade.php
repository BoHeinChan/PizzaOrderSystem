@extends('user.Layout.app')

@section('content')
    <!-- Page Content-->
    <div class="container px-4 px-lg-5" id="home">
        <!-- Heading Row-->
        <div class="row gx-4 gx-lg-5 align-items-center my-5" id="about">
            <a href="{{ route('user#index') }}" class="text-decoration-none text-black"><i
                    class="fas fa-arrow-left me-2"></i>Back</a>
            @if (Session::has('success_order'))
                <div class="alert alert-info alert-dismissible fade show my-2 mx-2" role="alert">
                    {{ Session::get('success_order') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" id="code-lab-pizza"
                    src="{{ asset('storage/uploads/' . $data->image) }}" alt="..." /></div>
            <div class="col-lg-5">
                <h1 class="font-weight-light">{{ $data->pizza_name }}</h1>
                <hr>
                <h6 class="font-weight-light">Description : {{ $data->description }}</h6>
                <hr>
                <h6 class="font-weight-light">Category Name : {{ $data->category_name }}</h6>
                <form action="{{ route('user#order', $data->pizza_id) }}">
                    @csrf
                    <hr>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label fw-bold">Count:</label>
                        <div class="col-sm-10">
                            <input type="number" name="count" class="form-control @error('count') is-invalid @enderror"
                                id="inputName" placeholder="Number of pizza..." value="{{ old('count') }}">
                            @error('count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('paymentStatus') is-invalid @enderror" type="radio"
                            name="paymentStatus" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1"> <i class="fa fa-cc-visa text-primary"
                                aria-hidden="true"></i>
                            VISA</label>
                        @error('paymentStatus')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('paymentStatus') is-invalid @enderror" type="radio"
                            name="paymentStatus" id="inlineRadio2" value="2">
                        <label class="form-check-label" for="inlineRadio2"> <i class="fa fa-money text-primary"
                                aria-hidden="true"></i>
                            CASH</label>
                        @error('paymentStatus')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <hr>
                    <h5 class="font-weight-light text-primary">Total price : {{ $data->price - $data->discount_price }}
                        Kyats
                    </h5>
                    <button class="btn btn-warning d-inline-block w-100 fw-bolder"> <i class="fa fa-shopping-cart"
                            aria-hidden="true"></i> Place Order Now</button>
                </form>
            </div>

        </div>
    @endsection
