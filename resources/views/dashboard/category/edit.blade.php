@extends('layouts.dashboardmaster')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center">Add New Brand</h4>
                    <form action="{{ route('category.update', $category->id) }}" method="POST">
                        @csrf

                        <div class="mb-2">
                            <label for="entry_by" class="form-label">Category Name <span class="text-danger">*</span></label>
                            <input name="category_name" type="text"
                                class="form-control @error('category_name') is-invalid @enderror" id="category_name"
                                placeholder="" value="{{ $category->category_name }}">
                            @error('category_name')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="entry_by" class="form-label">Entry By <span
                                    class="text-danger">*</span></label>
                            <input name="entry_by" type="text"
                                class="form-control @error('entry_by') is-invalid @enderror" id="entry_by" placeholder=""
                                value="{{ auth()->user()->name }}" readonly>
                            @error('entry_by')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- end col -->



    </div>
@endsection
