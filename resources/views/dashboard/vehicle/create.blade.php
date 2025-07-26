@extends('layouts.dashboardmaster')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center">Add New Vehicle</h4>

                    <form action="{{ route('vehicle.store') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="route_no" class="form-label"> Route No <span class="text-danger">*</span></label>
                            <input name="route_no" type="text"
                                class="form-control @error('route_no') is-invalid @enderror" id="route_no" placeholder=""
                                value="{{ old('route_no') }}">
                            @error('route_no')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="model_no" class="form-label"> Model No <span class="text-danger">*</span></label>
                            <input name="model_no" type="text"
                                class="form-control @error('model_no') is-invalid @enderror" id="model_no" placeholder=""
                                value="{{ old('model_no') }}">
                            @error('model_no')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2 row">
                            <label class="col-md-2 col-form-label" for="example-date">Date</label>
                            <div class="col-md-20">
                                <input class="form-control" type="date" name="date" id="example-date">
                            </div>
                        </div>


                        <div class="mb-2">
                            <label for="entry_by" class="form-label">Created By</label>
                            <input name="entry_by" type="text"
                                class="form-control @error('entry_by') is-invalid @enderror" id="entry_by"
                                placeholder="" value="{{ auth()->user()->name }}" readonly>
                            @error('entry_by')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Description</label>
                            <input type="hidden" name="note" id="item_description">
                            <div id="snow-editor" style="height: 300px;" class="ql-container ql-snow"></div>
                        </div>

                        <div class="form-check form-switch mt-1">
                            <input name="status" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                checked="1">

                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- end col -->



    </div>
@endsection

@section('script')
    <script>
        var quill = new Quill('#snow-editor', {
            theme: 'snow'
        });

        $('form').on('submit', function() {
            let description = document.querySelector('input[name=note]');
            description.value = quill.root.innerHTML;
        });
    </script>
@endsection
