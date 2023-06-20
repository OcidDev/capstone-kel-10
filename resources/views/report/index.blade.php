@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Saldo Sekarang</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cash-coin" style="font-size: 40px "></i>
                        </div>
                        <div class="ps-3">
                            <h4>{{ $curent_saldo->saldo }}</h4>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Keuntungan Bulan ini</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cash-coin" style="font-size: 40px "></i>
                        </div>
                        <div class="ps-3">
                            <h4>{{ $profit_month }}</h4>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <div class="swal2" data-swal2="{{ Session::get('success') }}">
                    </div>

                    <h5 class="card-title">Data Laporan</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <nav class="d-flex justify-content-end">
                        <button data-bs-toggle="modal" data-bs-target="#add" type="button"
                            class="btn btn-primary btn-sm">Add</button>
                    </nav>

                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Keuntungan</th>
                                    <th>Deskripsi</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data_laporan as $item)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $item->created_at->format('d M Y - H:i:s') }}</td>
                                        <td>Rp. {{ number_format($item->debit) }}</td>
                                        <td>Rp.{{ number_format($item->kredit) }}</td>
                                        <td>Rp.{{ number_format($item->profit) }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>Rp.{{ number_format($item->saldo) }}</td>
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

    <div class="modal fade" id="add" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Data Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('report.save') }}" method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="status" class="form-label">Jenis Laporan</label>
                            <select name="status" id="status" class="form-select" aria-label="Default select example">
                                <option selected disabled>Open this select menu</option>
                                <option value="Debit">Debit</option>
                                <option value="Kredit">Kredit</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="total" class="form-label">Total</label>
                            <input id="total" placeholder="Total" name="total" type="number" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label">Deskripsi</label>
                            <input id="description" placeholder="Deskripsi" name="description" type="text"
                                class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($data_laporan as $item)
        <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Laporam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" method="POST" action="{{ route('report.edit', $item->id) }}" method="POST">
                            @csrf
                            <div class="col-12">
                                <label for="status" class="form-label">Jenis Laporan</label>
                                <select name="status" id="status" class="form-select"
                                    aria-label="Default select example">
                                    <option selected disabled>Open this select menu</option>
                                    <option value="Debit">Debit</option>
                                    <option value="Kredit">Kredit</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Deskripsi</label>
                                <input id="description" value="{{ $item->description }}" placeholder="Deskripsi"
                                    name="description" type="text" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach







@endsection
