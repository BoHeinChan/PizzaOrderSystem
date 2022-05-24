@extends('admin.Layout.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('admin.add_pizza') }}"><button class="btn btn-dark"><i
                                            class="fas fa-solid fa-plus"></i></button></a>

                                <div class="card-tools">
                                    <form action="{{ route('admin.search_pizza') }}">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="table_search" class="form-control float-right" <div
                                                class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            @if (Session::has('successp'))
                                <div class="alert alert-info alert-dismissible fade show my-2 mx-2" role="alert">
                                    {{ Session::get('successp') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (Session::has('successdp'))
                                <div class="alert alert-info alert-dismissible fade show my-2 mx-2" role="alert">
                                    {{ Session::get('successdp') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (Session::has('successupdate'))
                                <div class="alert alert-info alert-dismissible fade show my-2 mx-2" role="alert">
                                    {{ Session::get('successupdate') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
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
                                </tbody>
                            </table>
                            <div class="mx-2 my-3">{{ $pizzas->links() }}</div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
