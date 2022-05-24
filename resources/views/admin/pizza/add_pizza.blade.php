@extends('admin.Layout.app') @section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-8 offset-3 mt-5">
                        <div class="col-md-11">
                            <a href="{{ route('admin.pizza') }}" class="text-decoration-none text-black"><i
                                    class="fas fa-solid fa-arrow-left me-2"></i>Back</a>
                            <div class="card">
                                <div class="card-header p-2">
                                    <legend class="text-center">Add Pizza</legend>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <form class="form-horizontal" action="{{ route('admin.create_pizza') }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="pizza_name"
                                                            class="form-control @error('pizza_name') is-invalid @enderror"
                                                            id="inputName" placeholder="Name"> @error('pizza_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Image</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" name="image"
                                                            class="form-control @error('image') is-invalid @enderror"
                                                            id="inputName" placeholder="Name"> @error('image')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Price</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" name="price"
                                                            class="form-control @error('price') is-invalid @enderror"
                                                            id="inputName" placeholder="Name"> @error('price')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName"
                                                        class="col-sm-2 col-form-label @error('publish') is-invalid @enderror">Publish
                                                        Status</label>
                                                    <div class="col-sm-10">
                                                        <select name="publish" class="form-select" id="">
                                                            <option value="1">Publish</option>
                                                            <option value="0">Unpublish</option>
                                                        </select> @error('publish')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Category</label>
                                                    <div class="col-sm-10">
                                                        <select name="category"
                                                            class="form-select @error('category') is-invalid @enderror"
                                                            id="">
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->category_id }}">
                                                                    {{ $category->category_name }}</option>
                                                            @endforeach
                                                        </select> @error('category')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Discount</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="discount"
                                                            class="form-control @error('discount') is-invalid @enderror"
                                                            id="inputName" placeholder="Name"> @error('discount')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row d-flex align-items-center">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Buy One Get
                                                        One</label>
                                                    <div class="col-sm-10">
                                                        <div class="form-check d-inline">
                                                            <input
                                                                class="form-check-input @error('buyOneGetOne') is-invalid @enderror"
                                                                type="radio" name="buyOneGetOne" value="1" id="buyOneGetOne"
                                                                checked>
                                                            <label class="form-check-label" for="buyOneGetOne">
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="form-check d-inline">
                                                            <input
                                                                class="form-check-input @error('buyOneGetOne') is-invalid @enderror"
                                                                type="radio" name="buyOneGetOne" value="0"
                                                                id="buyOneGetOne">
                                                            <label class="form-check-label" for="buyOneGetOne">
                                                                No
                                                            </label>
                                                        </div>
                                                        @error('buyOneGetOne')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Wainting
                                                        Time</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" name="waintingTime"
                                                            class="form-control @error('waintingTime') is-invalid @enderror"
                                                            id="inputName" placeholder="Name"> @error('waintingTime')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName"
                                                        class="col-sm-2 col-form-label">Description</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="description" id="inputName" class="form-control @error('description') is-invalid @enderror"
                                                            id="inputName" placeholder="Description" cols="5"
                                                            rows="3"></textarea> @error('description')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" class="btn bg-dark text-white">Add</button>
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
