@extends('admin.Layout.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12">
                        @if (Session::has('successupdate'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('successupdate') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="{{ route('admin.user_list') }}"><button
                                            class="btn btn-sm btn-outline-dark me-1">User List</button></a>
                                </h3>
                                <h3 class="card-title">
                                    <a href="{{ route('admin.admin_list') }}"><button
                                            class="btn btn-sm btn-outline-dark">Admin List</button></a>
                                </h3>
                                <h3 class="card-title">
                                    <a href="{{ route('admin.user_csv') }}" class="btn btn-sm mx-3 btn-primary">Download
                                        CSV</a>
                                </h3>
                                <div class="card-tools">
                                    <form action="{{ route('admin.search_user') }}" method="POST">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="searchUser" class="form-control float-right"
                                                placeholder="Search" value="{{ old('searchUser') }}">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <table class="table table-hover text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($userDatas) == null || count($userDatas) == 0)
                                            <tr>
                                                <td class="text-danger" colspan="6">There are no users.</td>
                                            </tr>
                                        @else
                                            @foreach ($userDatas as $userData)
                                                <tr>
                                                    <td>{{ $userData->id }}</td>
                                                    <td>{{ $userData->name }}</td>
                                                    <td>{{ $userData->email }}</td>
                                                    <td>{{ $userData->phone }}</td>
                                                    <td>{{ $userData->address }}</td>
                                                    <td>
                                                        <a href="#"><button class="btn btn-sm bg-danger text-white"><i
                                                                    class="fas fa-trash-alt"></i></button></a>
                                                        <a href="{{ route('admin.edit_user', $userData->id) }}"><button
                                                                class="btn btn-sm bg-dark text-white"><i
                                                                    class="fas fa-edit"></i></button></a>
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
                        <div class="mx-2 my-3">{{ $userDatas->links() }}</div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
