@extends('layouts.app')

@push('after-style')
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/datatables.min.css"
        rel="stylesheet" />
@endpush
@section('content')
    <div class="container">
        <!-- Button trigger modal -->
        <a class="btn btn-primary mb-3" href="{{ route('category.create') }}" role="button">Add Data</a>
        <div class="card">

            <div class="card-body table-responsive">
                <table id="DataTables" class="display table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection
@push('after-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            var datatable = $('#DataTables').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                },

                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false,
                        width: '100px'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '150px'
                    },
                ]
            });
        });
    </script>
@endpush
