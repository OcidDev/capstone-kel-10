@extends('layouts.app')


@section('contents')
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">


                    @if (Session::get('danger'))
                        <div class="swal3" data-swal3="{{ Session::get('danger') }}">
                        </div>
                    @else
                        <div class="swal2" data-swal2="{{ Session::get('success') }}">
                        </div>
                    @endif

                    <h5 class="card-title">Riwayat Transaksi</h5>

                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Tanggal</th>
                                    <th>Nama Supplier</th>
                                    <th>Phone Supplier</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($inventories as $inventory)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $inventory->invoice_code }}</td>
                                        <td>{{ $inventory->created_at->format('d M Y - H:i:s') }}</td>
                                        <td>{{ $inventory->supplier->name }}</td>
                                        <td>{{ $inventory->supplier->phone }}</td>
                                        <td>Rp. {{ number_format($inventory->total, 0) }}</td>
                                        <td> <span class="badge rounded-pill bg-success">{{ $inventory->status }}</span>
                                        </td>
                                        <td><a href="{{ route('inventory_list_detail', $inventory->id) }}">Detail</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
@endsection
