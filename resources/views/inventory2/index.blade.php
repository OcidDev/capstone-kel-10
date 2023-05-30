@extends('layouts.app')

@section('title', 'Inventory')
@push('style')
    <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/datatables.min.css"
        rel="stylesheet" />
@endpush
@section('contents')


    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <div class="swal2" data-swal2="{{ Session::get('success') }}">
                    </div>

                    <nav class="d-flex justify-content-end">
                        <a class="btn btn-primary m-3" href="{{ route('inventory.create') }}" role="button">Add Data</a>
                        {{-- <button data-bs-toggle="modal" data-bs-target="#add" type="button"
                            class="btn btn-primary btn-sm">Add</button> --}}
                    </nav>

                    <!-- Table with stripped rows -->
                    <table class="display table table-striped table-hover" id="DataTables">
                        <thead>
                            <tr>
                                <th scope="col">Nama Supplier</th>
                                <th scope="col">Nama Produk/Code Produk</th>
                                <th scope="col">Nama Penerima</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Tanggal Transaksi</th>
                                <th scope="col">Jumlah (quantity)</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>

@endsection
@push('script')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
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
                        data: 'supplier.name',
                        name: 'supplier.name'
                    },
                    {
                        data: 'product.name',
                        name: 'product.name'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'invoice_code',
                        name: 'invoice_code'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'status',
                        name: 'status'
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
