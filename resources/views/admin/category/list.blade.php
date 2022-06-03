@extends('admin.Layout.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12">
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (Session::has('successd'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('successd') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (Session::has('successu'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ Session::get('successu') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="{{ route('admin.add_category') }}"><button
                                            class="btn btn-sm btn-outline-dark">Add Category</button></a>
                                </h3>
                                <a href="{{ route('admin.csv') }}" class="btn btn-sm mx-3 btn-primary">Download CSV</a>
                                <div class="card-tools">
                                    <form action="{{ route('admin.serach_category') }}">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="searchCategory" class="form-control float-right"
                                                placeholder="Search" value="{{ old('searchCategory') }}">

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
                                            <th>Category Name</th>
                                            <th>Product Count</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($pizzas) == null || count($pizzas) == 0)
                                            <tr>
                                                <td colspan="4" class="text-danger">There are no categories.</td>
                                            </tr>
                                        @else
                                            @foreach ($pizzas as $pizza)
                                                <tr>
                                                    <td>{{ $pizza->category_id }}</td>
                                                    <td>{{ $pizza->category_name }}</td>
                                                    <td>
                                                        @if ($pizza->count == 0)
                                                            <a class="text-decoration-none"
                                                                href="#">{{ $pizza->count }}</a>
                                                        @else
                                                            <a class="text-decoration-none"
                                                                href="{{ route('admin.category_detail', $pizza->category_id) }}">{{ $pizza->count }}</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="{{ route('admin.edit_category', $pizza->category_id) }}"><button
                                                                class="btn btn-sm bg-dark text-white"><i
                                                                    class="fas fa-edit"></i></button></a>
                                                        <a
                                                            href="{{ route('admin.delete_category', $pizza->category_id) }}"><button
                                                                class="btn btn-sm bg-danger text-white"><i
                                                                    class="fas fa-trash-alt"></i></button></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="mx-2 my-3">{{ $pizzas->links() }}</div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
