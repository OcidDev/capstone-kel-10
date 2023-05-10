@extends('layouts.app')

@section('content')
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/datatables.min.css"
        rel="stylesheet" />
    <div class="card">
        <div class="card-body table-responsive ">
            <table id="DataTables" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>

        </div> <!-- end card body-->
    </div> <!-- end card -->
    <!-- third party js -->
@endsection
@push('after-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            var datatable = $('#DataTables').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url:'{!! url()->current() !!}',
                },

                columns: [
                    { data:'name', name:'name'},
                    { data:'email', name:'email'},
                    {
                        data:'action',
                        name:'action',
                        orderable:false,
                        searchable:false,
                        width:'150px'
                    },
                ]
            });
        });
    </script>
@endpush
