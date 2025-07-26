@extends('layouts.dashboardmaster')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center">Update Vehicle</h4>
                    <form id="item-form" action="{{ route('vehicle.update', $vehicle->id) }}" method="POST">
                        @csrf

                        <div class="mb-2">
                            <label for="route_no" class="form-label">Route No <span class="text-danger">*</span></label>
                            <input name="route_no" type="text"
                                class="form-control @error('route_no') is-invalid @enderror" id="route_no"
                                value="{{ old('route_no', $vehicle->route_no) }}">
                            @error('route_no')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="model_no" class="form-label">Model No <span class="text-danger">*</span></label>
                            <input name="model_no" type="text"
                                class="form-control @error('model_no') is-invalid @enderror" id="model_no"
                                value="{{ old('model_no', $vehicle->model_no) }}">
                            @error('model_no')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2 row">
                            <label class="col-md-2 col-form-label" for="example-date">Date</label>
                            <div class="col-md-20">
                                <input class="form-control" type="date" name="date" id="example-date"
                                    value="{{ old('date', \Carbon\Carbon::parse($vehicle->registration_date)->format('Y-m-d')) }}">
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="created_by" class="form-label">Created By</label>
                            <input name="created_by" type="text"
                                class="form-control @error('created_by') is-invalid @enderror" id="created_by"
                                value="{{ old('created_by', $vehicle->created_by) }}" readonly>
                            @error('created_by')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label class="form-label">Note</label>
                            <input type="hidden" name="note" id="item_description"
                                value="{{ old('none', $vehicle->note) }}">
                            <div id="snow-editor" style="height: 300px;"></div>
                        </div>

                        <div class="form-check form-switch mt-1">
                            <input name="status" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                {{ old('status', $vehicle->status) ? 'checked' : '' }}>
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

        // Load existing value from hidden input
        let existing = document.getElementById('item_description').value;
        quill.clipboard.dangerouslyPasteHTML(existing);

        // On form submit, update hidden input with new content
        document.getElementById('item-form').addEventListener('submit', function() {
            document.getElementById('item_description').value = quill.root.innerHTML;
        });
    </script>
@endsection
