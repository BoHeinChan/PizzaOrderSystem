@extends('admin.Layout.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-8 offset-3 mt-5">
                    <div class="col-md-9">
                        <a href="{{ route('admin.category')}}" class="text-decoration-none text-black"><i class="fas fa-solid fa-arrow-left me-2"></i>Back</a>
                        <div class="card">
                            <div class="card-header p-2">
                                <legend class="text-center">Add Category</legend>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <form class="form-horizontal" action="{{ route('admin.add_category')}}" method="POST">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" id="inputName"
                                                        placeholder="Name">
                                                        @error('category_name')
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
