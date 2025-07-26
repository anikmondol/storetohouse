@extends('layouts.dashboardmaster')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center">Add New Maintenance</h4>
                    <form action="{{ route('maintenance.store') }}" method="POST">
                        @csrf
                        <div class="mb-2 row">
                            <div class="col-md-6 mb-2">
                                <label class="col-md-2 col-form-label" for="maint_date">Date</label>
                                <div class="col-md-12">
                                    <input class="form-control" type="date" name="maint_date" id="maint_date">
                                </div>
                                @error('maint_date')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-2">
                                    <label for="bus_id" class="form-label">Bus Id</label>
                                    <select name="bus_id" class="form-select">
                                        <option value="">Select By Id</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}"
                                                {{ old('vehicle') == $vehicle->id ? 'selected' : '' }}>
                                                {{ $vehicle->id }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('bus_id')
                                        <span class="invalid-feedback text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <div class="col-md-6 mb-2">
                                <label for="amount" style="margin-bottom: 1rem" class="form-label"> Amount</label>
                                <input name="amount" type="number"
                                    class="form-control @error('amount') is-invalid @enderror" id="amount"
                                    placeholder="">
                                @error('amount')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="remarks" style="margin-bottom: 1rem" class="form-label">Remarks</label>
                                <input name="remarks" type="text"
                                    class="form-control @error('remarks') is-invalid @enderror" id="remarks"
                                    placeholder="">
                                @error('remarks')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-2 row">

                            <div class="col-md-6 mb-2">
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
