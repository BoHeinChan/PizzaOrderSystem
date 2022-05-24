@extends('user.Layout.app')

@section('content')
    <!-- Page Content-->
    <div class="container px-4 px-lg-5" id="home">
        <!-- Heading Row-->
        <div class="row gx-4 gx-lg-5 align-items-center my-5" id="about">
            <a href="{{ route('user#index') }}" class="text-decoration-none text-black"><i
                    class="fas fa-arrow-left me-2"></i>Back</a>
            <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" id="code-lab-pizza"
                    src="{{ asset('storage/uploads/' . $data->image) }}" alt="..." /></div>
            <div class="col-lg-5">
                <h1 class="font-weight-light">{{ $data->pizza_name }}</h1>
                <hr>
                <h6 class="font-weight-light">Description : {{ $data->description }}</h6>
                <hr>
                <h6 class="font-weight-light">Category Name : {{ $data->category_name }}</h6>
                <hr>
                <h6 class="font-weight-light">Price : {{ $data->price }} Kyats</h6>
                <hr>
                <h6 class="font-weight-light">Discount : {{ $data->discount_price }} Kyats</h6>
                <hr>
                <h6 class="font-weight-light">Waiting Time : {{ $data->waiting_time }}</h6>
                <hr>
                <h5 class="font-weight-light text-primary">Total price : {{ $data->price - $data->discount_price }} Kyats
                </h5>
                <a href="{{ route('user#order_page', $data->pizza_id) }}" class="d-inline-block w-100 mt-2"><button
                        class="btn btn-dark d-inline-block w-100">Order
                        Now</button></a>
            </div>

        </div>
    @endsection
