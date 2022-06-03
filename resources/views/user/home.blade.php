@extends('user.Layout.app')

@section('content')
    <!-- Page Content-->
    <div class="container px-4 px-lg-5" id="home">
        <!-- Heading Row-->
        <div class="row gx-4 gx-lg-5 align-items-center my-5" id="about">
            <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" id="code-lab-pizza"
                    src="https://www.pizzamarumyanmar.com/wp-content/uploads/2019/04/chigago.jpg" alt="..." /></div>
            <div class="col-lg-5">
                <h1 class="font-weight-light">CODE LAB Pizza</h1>
                <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it,
                    but it makes a great use of the standard Bootstrap core components. Feel free to use this template
                    for any project you want!</p>
                <a class="btn btn-primary" href="#!">Enjoy!</a>
            </div>
        </div>

        <!-- Content Row-->
        <div class="d-flex justify-content-around" id="pizzas">
            <div class="col-3 me-5">
                <div class="">
                    <div class="py-5 text-center">
                        <form class="d-flex m-5" action="{{ route('user#pizza_search') }}">
                            @csrf
                            <input class="form-control me-2" type="search" name="search_data" placeholder="Search"
                                aria-label="Search">
                            <button class="btn btn-outline-dark" type="submit">Search</button>
                        </form>

                        <div class="">
                            <div class="m-2 p-2"><a href="{{ route('user#index') }}" class="text-black">All</a>
                            </div>
                            @foreach ($categories as $category)
                                <div class="m-2 p-2"><a
                                        href="{{ route('user#category_search', $category->category_id) }}"
                                        class="text-black">{{ $category->category_name }}</a></div>
                            @endforeach
                        </div>
                        <hr>
                        <form action="{{ route('user#custom_search') }}">
                            @csrf
                            <div class="text-center m-4 p-2">
                                <h3 class="mb-3">Start Date - End Date</h3>

                                <input type="date" name="startDate" id="" class="form-control"> -
                                <input type="date" name="endDate" id="" class="form-control">
                            </div>
                            <hr>
                            <div class="text-center m-4 p-2">
                                <h3 class="mb-3">Min - Max Amount</h3>

                                <input type="number" name="minPrice" id="" class="form-control"
                                    placeholder="minimum price"> -
                                <input type="number" name="maxPrice" id="" class="form-control"
                                    placeholder="maximun price">
                            </div>
                            <button type="submit" class="btn btn-dark">Search <i class="fa fa-search"
                                    aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-5 w-100">
                <div class="row gx-4 gx-lg-5 w-100" id="pizza">
                    @if (count($pizzas) != 0)
                        @foreach ($pizzas as $pizza)
                            <div class="col-md-4 mb-5 d-flex justify-content-around flex-wrap">
                                <div class="card h-100 w-100">
                                    <!-- Sale badge-->

                                    @if ($pizza->buy_one_get_one_status == 1)
                                        <div class="badge bg-danger text-white position-absolute"
                                            style="top: 0.5rem; right: 0.5rem">
                                            Buy one get one</div>
                                    @endif
                                    <!-- Product image-->
                                    <img class="card-img-top" src="{{ asset('storage/uploads/' . $pizza->image) }}"
                                        alt="Pizza Item" />
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">{{ $pizza->pizza_name }}</h5>
                                            <!-- Product price-->
                                            <span
                                                class="text-muted text-decoration-line-through">{{ $pizza->discount_price }}</span>
                                            {{ $pizza->price }} Kyats
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                                href="{{ route('user#pizza_detail', $pizza->pizza_id) }}">More
                                                Detail</a></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h2 class="font-weight-light text-danger mt-5 text-center">There are no pizzas!</h2>
                    @endif
                </div>
            </div>
            <div class="mx-2 my-3">{{ $pizzas->links() }}</div>
        </div>
    </div>
    <div class="text-center d-flex justify-content-center align-items-center" id="contact">
        <div class="col-4 border shadow-sm ps-5 pt-5 pe-5 pb-2 mb-5">
            <h3>Contact Us</h3>

            <form action="{{ route('user#contact') }}" class="my-4" method="POST">
                @csrf
                <input type="text" name="name" id="" class="form-control my-3 @error('name') is-invalid @enderror"
                    placeholder="Name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <input type="email" name="email" id="" class="form-control my-3 @error('email') is-invalid @enderror"
                    placeholder="Email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <textarea class="form-control my-3 @error('message') is-invalid @enderror" name="message"
                    id="exampleFormControlTextarea1" rows="3" placeholder="Message"></textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-outline-dark">Send <i class="fas fa-arrow-right"></i></button>
            </form>
        </div>
    </div>
@endsection
