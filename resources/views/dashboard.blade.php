@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">


                    <div class=" col-md-3">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Kategori</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-collection"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $categories }}</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class=" col-md-3">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Rak</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-archive"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $shelves }}</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class=" col-md-3">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Supplier</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $suppliers }}</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class=" col-md-3">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Produk</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-basket"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $products }}</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class=" col-md-3">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Transaksi Lunas</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-basket"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $transactions_lunas }}</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class=" col-md-3">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Jumlah Lunas</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-basket"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>Rp {{ number_format($transactions_lunas_total) }}</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class=" col-md-3">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Transaksi Belum Lunas</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-basket"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $transactions_offpaid }}</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class=" col-md-3">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Jumlah Belum Lunas</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-basket"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>Rp {{ number_format($transactions_offpaid_total) }}</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card p-3">
                            <h3>Stok Produk Hampir Habis</h3>
                            <table class="table mt-5 datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Produk</th>
                                        <th scope="col">Gambar Product</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Nama Kategori</th>
                                        <th scope="col">Nama Rak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($product_kritis as $item)
                                        <tr>
                                            <th scope="row">{{ $no++ }}</th>
                                            <td>{{ $item->product_code }}</td>
                                            <td> <img src="{{ Storage::url($item->image) }}" style="width:100px" alt="image">
                                            <td>{{ $item->name }}</td>
                                            <td>Sisa {{ $item->stock }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->shelves->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
