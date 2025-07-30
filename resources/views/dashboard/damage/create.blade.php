@extends('layouts.dashboardmaster')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('damage.store') }}" method="POST">
                        @csrf
                        <div class="mb-2 row">
                            <div class="col-lg-6">
                                <div class="mt-2">
                                    <label for="item_name" class="form-label">Item Name</label>
                                    <select name="item_name" class="form-select">
                                        <option value="">Select By Id</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('item') == $item->id ? 'selected' : '' }}>
                                                {{ $item->item_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('item_name')
                                        <span class="invalid-feedback text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-2">
                                    <label for="store_id" class="form-label">Store Name</label>
                                    <select name="store_id" class="form-select"> <!-- store_name → store_id -->
                                        <option value="">Select By Id</option>
                                        @foreach ($stores as $store)
                                            <option value="{{ $store->id }}"
                                                {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                                {{ $store->store_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('store_id')
                                        <span class="invalid-feedback text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="mb-2 row">

                            <div class="col-md-6 mb-2">
                                <label for="item_qty" style="margin-bottom: 1rem" class="form-label"> Quantify</label>
                                <input name="item_qty" type="number"
                                    class="form-control @error('item_qty') is-invalid @enderror" id="item_qty"
                                    placeholder="">
                                @error('item_qty')
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
                                <label for="entry_by" class="form-label">Received By</label>
                                <input name="entry_by" type="text"
                                    class="form-control @error('entry_by') is-invalid @enderror" id="entry_by"
                                    placeholder="" value="{{ auth()->user()->name }}" readonly>
                                @error('entry_by')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="col-md-2 col-form-label pt-0" for="damage_date">Date</label>
                                <div class="col-md-12">
                                    <input class="form-control" type="date" name="damage_date" id="damage_date">
                                </div>
                                @error('damage_date')
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
    @endif
@endsection
