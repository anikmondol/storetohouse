@extends('layouts.dashboardmaster')

@section('content')
    <!-- start page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                        <h4>Store Table</h4>
                        <button onclick="window.location.href='{{ route('store.create') }}'" type="button"
                            class="btn btn-info waves-effect waves-light">Add Store</button>
                    </div>

                    <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Store ID</th>
                                <th>Store Name</th>
                                <th>Store Location</th>
                                <th>Entry Date</th>
                                <th>Entry By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stores as $key => $store)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $store->id }}</td>
                                    <td>{{ $store->store_name }}</td>
                                    <td>{{ $store->store_location }}</td>
                                    <td>{{ $store->created_at }}</td>
                                    <td>{{ $store->store_entry_by }}</td>
                                    <td>
                                        <a href="{{ route('store.edit', $store->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bx bx-file"></i> Edit</a>
                                        <form action="{{ route('store.destroy', $store->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf

                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')"> <i class="mdi mdi-trash-can"></i>
                                                Delete</button>
                                        </form>
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
