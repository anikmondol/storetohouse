@extends('layouts.dashboardmaster')

@section('content')
    <!-- start page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                        <h4>Brand Table</h4>
                        <button onclick="window.location.href='{{ route('brand.create') }}'" type="button"
                            class="btn btn-info waves-effect waves-light">Add Brand</button>
                    </div>

                    <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Brand Id</th>
                                <th>Brand Name</th>
                                <th>Brand Country</th>
                                <th>Entry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->brand_name }}</td>
                                    <td>{{ $value->brand_country }}</td>
                                    <td>{{ date('d-m-Y', strtotime($value->updated_at)) }}<br>
                                        {{ date('h:i:s a', strtotime($value->updated_at)) }}</td>
                                    <td>
                                        <a href="{{ route('brand.edit', $value->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('brand.destroy', $value->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf

                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
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
