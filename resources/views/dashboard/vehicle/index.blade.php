@extends('layouts.dashboardmaster')

@section('content')
    <!-- start page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                        <h4>Vehicle Table</h4>
                        <button onclick="window.location.href='{{ route('vehicle.create') }}'" type="button"
                            class="btn btn-info waves-effect waves-light">Add Vehicle</button>
                    </div>

                    <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Route No</th>
                                <th>Model No</th>
                                <th>Registration Date</th>

                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($vehicles as $key => $vehicle)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $vehicle->route_no }}</td>
                                    <td>{{ $vehicle->model_no }}</td>
                                    <td>{{ $vehicle->registration_date }}</td>
                                    <td>{{ $vehicle->created_by }}</td>
                                    <td>
                                        <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bx bx-file"></i> Edit</a>
                                        <form action="{{ route('vehicle.destroy', $vehicle->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')"> <i class="mdi mdi-trash-can"></i>
                                                Delete</button>
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
