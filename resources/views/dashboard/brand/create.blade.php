@extends('layouts.dashboardmaster')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center">Add New Brand</h4>

                    <form action="{{ route('brand.store') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="brand_name" class="form-label">Brand Name <span class="text-danger">*</span></label>
                            <input name="brand_name" type="text"
                                class="form-control @error('brand_name') is-invalid @enderror" id="brand_name"
                                placeholder="" value="{{ old('brand_name') }}">
                            @error('brand_name')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="brand_country" class="form-label">Brand country <span class="text-danger">*</span></label>
                            <input name="brand_country" type="text"
                                class="form-control @error('brand_country') is-invalid @enderror" id="brand_country"
                                placeholder="" value="{{ old('brand_country') }}">
                            @error('brand_country')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="brand_entry" class="form-label">Brand Entry By</label>
                            <input name="brand_entry" type="text"
                                class="form-control @error('brand_entry') is-invalid @enderror" id="brand_entry"
                                placeholder="" value="{{ old('brand_entry') }}">
                            @error('brand_entry')
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
