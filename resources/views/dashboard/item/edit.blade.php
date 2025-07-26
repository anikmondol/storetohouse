@extends('layouts.dashboardmaster')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3 text-center">Add New Item</h4>

                    <form id="item-form" action="{{ route('item.update', $item->id) }}" method="POST">
                        @csrf

                        {{-- Item Name --}}
                        <div class="mb-2">
                            <label for="item_name" class="form-label">Item Name <span class="text-danger">*</span></label>
                            <input name="item_name" type="text"
                                class="form-control @error('item_name') is-invalid @enderror" id="item_name"
                                value="{{ old('item_name', $item->item_name) }}">
                            @error('item_name')
                                <span class="invalid-feedback text-danger"
                                    role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        {{-- Row 1: Brand & Category --}}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-3">
                                    <label for="brand" class="form-label">Brand</label>
                                    <select name="brand" class="form-select @error('brand') is-invalid @enderror">
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ old('brand', $item->brand) == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->brand_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                        <span class="invalid-feedback text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select name="category" class="form-select @error('category') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category', $item->category) == $category->id ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Row 2: Unit & Entry By --}}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-3">
                                    <label for="item_unit" class="form-label">Item Unit</label>
                                    <select name="item_unit" class="form-select @error('item_unit') is-invalid @enderror">
                                        <option value="">Select Unit</option>
                                        <option value="pcs"
                                            {{ old('item_unit', $item->item_unit) == 'pcs' ? 'selected' : '' }}>pcs
                                        </option>
                                        <option value="kg"
                                            {{ old('item_unit', $item->item_unit) == 'kg' ? 'selected' : '' }}>kg</option>
                                        <option value="litre"
                                            {{ old('item_unit', $item->item_unit) == 'litre' ? 'selected' : '' }}>litre
                                        </option>
                                    </select>
                                    @error('item_unit')
                                        <span class="invalid-feedback text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6" style="margin-top: 18px">
                                <label for="item_entry_by" class="form-label">Item Entry By</label>
                                <input name="item_entry_by" type="text"
                                    class="form-control @error('item_entry_by') is-invalid @enderror"
                                    value="{{ old('item_entry_by', auth()->user()->name) }}" readonly>
                                @error('item_entry_by')
                                    <span class="invalid-feedback text-danger"
                                        role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Description using Quill --}}
                        <!-- Hidden input + Quill container -->
                        <div class="mt-3">
                            <label class="form-label">Description</label>
                            <input type="hidden" name="description" id="item_description"
                                value="{{ old('description', $item->description) }}">
                            <div id="snow-editor" style="height: 300px;"></div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>




                </div>
            </div>
        </div>
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
