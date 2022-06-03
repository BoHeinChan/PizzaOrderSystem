@extends('admin.Layout.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12">
                        @if (Session::has('successp'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('successp') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (Session::has('successdp'))
                            <div class="alert alert-default-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('successdp') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (Session::has('successupdate'))
                            <div class="alert alert-default-warning alert-dismissible fade show" role="alert">
                                {{ Session::get('successupdate') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="{{ route('admin.add_pizza') }}"><button
                                            class="btn btn-sm btn-outline-dark">Add Pizza</button></a>
                                </h3>
                                <a href="{{ route('admin.pizza_csv') }}" class="btn btn-sm mx-3 btn-primary">Download
                                    CSV</a>
                                <div class="card-tools">
                                    <form action="{{ route('admin.search_pizza') }}">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="table_search" class="form-control float-right"
                                                placeholder="Search" value="{{ old('table_search') }}">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Pizza Name</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Publish Status</th>
                                            <th>Buy 1 Get 1 Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($pizzas) == null || count($pizzas) == 0)
                                            <tr>
                                                <td colspan="7" class="text-danger">There are no pizzas.</td>
                                            </tr>
                                        @else
                                            @foreach ($pizzas as $pizza)
                                                <tr>
                                                    <td>{{ $pizza->pizza_id }}</td>
                                                    <td>{{ $pizza->pizza_name }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/uploads/' . $pizza->image) }}"
                                                            class="img-thumbnail" width="100px">
                                                    </td>
                                                    <td>{{ $pizza->price }} Kyats</td>
                                                    <td>
                                                        @if ($pizza->publish_status == 1)
                                                            Yes
                                                        @else
                                                            No
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($pizza->buy_one_get_one_status == 1)
                                                            Yes
                                                        @else
                                                            No
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.edit_pizza', $pizza->pizza_id) }}">
                                                            <button class="btn btn-sm bg-dark text-white"><i
                                                                    class="fas fa-edit"></i></button>
                                                        </a>
                                                        <a href="{{ route('admin.delete_pizza', $pizza->pizza_id) }}"><button
                                                                class="btn btn-sm bg-danger text-white"><i
                                                                    class="fas fa-trash-alt"></i></button></a>
                                                        <a href="{{ route('admin.pizza_info', $pizza->pizza_id) }}"><button
                                                                class="btn btn-sm bg-primary text-white"><i
                                                                    class="fas fa-solid fa-eye"></i></button></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="mx-2 my-3">{{ $pizzas->links() }}</div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
