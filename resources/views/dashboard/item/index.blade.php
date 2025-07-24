@extends('layouts.dashboardmaster')

@section('content')
    <!-- start page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                        <h4>Item Table</h4>
                        <button onclick="window.location.href='{{ route('item.create') }}'" type="button"
                            class="btn btn-info waves-effect waves-light">Add Brand</button>
                    </div>

                    <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                        <thead>
                            <tr>
                            <tr>
                                <th>ID</th>
                                <th>Item Name</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th>Entry By</th>
                                <th>Action</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->item_name }}</td>
                                    <td>{{ $value->brand_name }}</td>
                                    <td>{{ $value->category_name }}</td>
                                    <td>{{ $value->item_unit }}</td>
                                    <td>{{ date('d-m-Y', strtotime($value->updated_at)) }}<br>
                                        {{ date('h:i:s a', strtotime($value->updated_at)) }}</td>
                                    <td>
                                        <a href="{{ route('item.edit', $value->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bx bx-file"></i> Edit</a>
                                        <form action="{{ route('item.destroy', $value->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="mdi mdi-trash-can"></i> Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
@endsection

@section('script')
    @if (session('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                duration: 5000,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
                onClick: function() {} // Callback after click
            }).showToast();
        </script>
    @endif
@endsection
