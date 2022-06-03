@extends('admin.Layout.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12">
                        <a href="{{ route('admin.category') }}"><button class="btn btn-dark mb-1"> <i
                                    class="fa fa-arrow-left" aria-hidden="true"></i></button></a>
                        <div class="card">
                            <div class="card-header text-center">
                                <p class="fw-bold fs-4 m-0">{{ $pizzas[0]->category_name }}</p>
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
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="mx-2 my-3">{{ $pizzas->links() }}</div>
                    </div>
                </div>
            </div>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
