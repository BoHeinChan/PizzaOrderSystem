@extends('admin.Layout.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-8 offset-3 mt-5">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <legend class="text-center">Edit Category</legend>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <form class="form-horizontal" action="{{ route('admin.update_category', $pizza->category_id)}}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" id="inputName"
                                                        placeholder="Name" value="{{ old('category_name') ?? $pizza->category_name }}">
                                                        @error('category_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn bg-dark text-white">Update</button>
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
