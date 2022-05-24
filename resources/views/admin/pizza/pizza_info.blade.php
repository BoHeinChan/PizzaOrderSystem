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
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-5">
                                <div class="alert alert-info">
                                    <div class="d-flex align-items-center justify-content-around">
                                        <div class="">
                                            <img src="{{ asset('storage/uploads/' . $infos->image) }}"
                                                class="img-thumbnail" style="width: 20rem">
                                        </div>
                                        <div class="">
                                            <p>Name: {{ $infos->pizza_name }}</p>
                                            <p>Price: {{ $infos->price }}Kyats</p>
                                            <p>Publish Status: {{ $infos->publish_status }}</p>
                                            <p>Buy One get One: {{ $infos->buy_one_get_one_status }}</p>
                                        </div>
                                    </div>
                                </div>
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
