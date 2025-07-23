@extends('layouts.dashboardmaster')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center">Add New Store</h4>

                    <form action="{{ route('store.store') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="store_name" class="form-label">Store Name <span class="text-danger">*</span></label>
                            <input name="store_name" type="text"
                                class="form-control @error('store_name') is-invalid @enderror" id="store_name"
                                placeholder="" value="{{ old('store_name') }}">
                            @error('store_name')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="store_location" class="form-label">Store country <span class="text-danger">*</span></label>
                            <input name="store_location" type="text"
                                class="form-control @error('store_location') is-invalid @enderror" id="store_location"
                                placeholder="" value="{{ old('store_location') }}">
                            @error('store_location')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="store_entry_by" class="form-label">Store Entry By</label>
                            <input name="store_entry_by" type="text"
                                class="form-control @error('store_entry_by') is-invalid @enderror" id="store_entry_by"
                                placeholder="" value="{{ auth()->user()->name }}" readonly>
                            @error('store_entry_by')
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
