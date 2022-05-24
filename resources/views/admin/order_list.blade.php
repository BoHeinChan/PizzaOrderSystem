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

                                <div class="card-tools">
                                    <form action="#">
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
                            <table class="table table-hover text-nowrap text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Pizza Name</th>
                                        <th>Payment</th>
                                        <th>Count</th>
                                        <th>Order Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $data)
                                        <tr>
                                            <td>{{ $data->order_id }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->pizza_name }}</td>
                                            @if ($data->payment_status == 1)
                                                <td>VISA</td>
                                            @elseif ($data->payment_status == 2)
                                                <td>CASH</td>
                                            @endif
                                            <td>{{ $data->count }}</td>
                                            <td>{{ $data->order_time }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mx-2 my-3">{{ $orders->links() }}</div>
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
