@extends('layouts.dashboardmaster')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('received.store') }}" method="POST">
                        @csrf
                        <div class="mb-2 row">
                            <div class="col-lg-6">
                                <div class="mt-2">
                                    <label for="item_name" class="form-label">Item Name</label>
                                    <select name="item_name" class="form-select">
                                        <option value="">Select By Id</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}"
                                                {{ old('vehicle') == $vehicle->id ? 'selected' : '' }}>
                                                {{ $vehicle->item_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('item_name')
                                        <span class="invalid-feedback text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="quantity" style="margin-bottom: 1rem" class="form-label"> Item Qty</label>
                                <input name="quantity" type="number"
                                    class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                                    placeholder="">
                                @error('quantity')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-2 row">

                            <div class="col-md-6 mb-2">
                                <label for="unit_price" style="margin-bottom: 1rem" class="form-label"> Unit Price</label>
                                <input name="unit_price" type="number"
                                    class="form-control @error('unit_price') is-invalid @enderror" id="unit_price"
                                    placeholder="">
                                @error('unit_price')
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

                        <div class="row mb-2">
                            <div class="col-md-6 mb-2">
                                <label for="received_by" class="form-label">Received By</label>
                                <input name="received_by" type="text"
                                    class="form-control @error('received_by') is-invalid @enderror" id="received_by"
                                    placeholder="" value="{{ auth()->user()->name }}" readonly>
                                @error('received_by')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="col-md-2 col-form-label pt-0" for="maint_date">Date</label>
                                <div class="col-md-12">
                                    <input class="form-control" type="date" name="maint_date" id="maint_date">
                                </div>
                                @error('maint_date')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>


                        <div class="mt-3">
                            <label class="form-label">Description</label>
                            <input type="hidden" name="item_description" id="item_description">
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
            let description = document.querySelector('input[name=item_description]');
            description.value = quill.root.innerHTML;
        });
    </script>


    @if (session('error'))
        @if (session('error'))
            <script>
                Toastify({
                    text: "{{ session('error') }}",
                    duration: 5000,
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "linear-gradient(to right, #ff5f6d, #ffc371)", // more error-like colors
                    },
                    onClick: function() {} // Callback after click
                }).showToast();
            </script>
        
    @endif
@endsection
