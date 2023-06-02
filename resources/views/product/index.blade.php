@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')


    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <div class="swal2" data-swal2="{{ Session::get('success') }}">
                    </div>

                    <h5 class="card-title">Data Produk</h5>
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
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Rak</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Kode Produk</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Deskripsi Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Modal</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data_products as $item)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->shelves->name }}</td>
                                    <td> <img src="{{ Storage::url($item->image) }}" style="width:100px" alt="image">
                                    </td>
                                    <td>{{ $item->product_code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>Rp. {{ number_format($item->price, 0) }}</td>
                                    <td>Rp. {{ number_format($item->capital_price, 0) }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('product.delete', $item->id) }}">
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $item->id }}"
                                                class="btn btn-sm btn-warning">Edit</button>

                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit"
                                                class="btn btn-danger btn-flat show-alert-delete-box btn-sm"
                                                data-toggle="tooltip" title='Delete'>Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="add" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Data Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('product.save') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label class="form-label">Kategori Produk</label>
                            <select class="form-select" name="categories_id">
                                <option selected disabled value="">Pilih Kategori Produk</option>
                                @foreach ($data_category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Rak Produk</label>
                            <select class="form-select" name="shelves_id">
                                <option disabled value="" selected>Pilih Rak Produk</option>
                                @foreach ($data_rak as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="product_code" class="form-label">Kode Produk</label>
                            <input type="text" placeholder="Kode Produk" id="product_code" name="product_code"
                                class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" placeholder="Nama Produk" id="name" name="name"
                                class="form-control">
                        </div>


                        <div class="col-12">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">Deskripsi Produk</label>
                            <input id="description" placeholder="Deskripsi" name="description" type="text"
                                class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="price" class="form-label">Harga Produk</label>
                            <input type="text" id="price" placeholder="Harga Produk" name="price"
                                type="text" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="modal" class="form-label">Modal Produk</label>
                            <input type="text" id="capital_price" placeholder="Modal" name="capital_price"
                                type="text" class="form-control">
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

    @foreach ($data_products as $item)
        <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" method="POST" action="{{ route('product.edit', $item->id) }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="col-12">
                                <label class="form-label">Kategori Produk</label>
                                <select class="form-select" name="categories_id">
                                    @foreach ($data_category as $item_c)
                                        <option
                                            value="{{ $item_c->id }}"{{ $item->categories_id == $item_c->id ? 'Selected' : '' }}>
                                            {{ $item_c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Rak Produk</label>
                                <select class="form-select" name="shelves_id">
                                    @foreach ($data_rak as $item_r)
                                        <option
                                            value="{{ $item_r->id }}"{{ $item->raks_id == $item_r->id ? 'Selected' : '' }}>
                                            {{ $item_r->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="product_code" class="form-label">Kode Produk</label>
                                <input type="text" value="{{ $item->product_code }}" placeholder="Kode Produk"
                                    id="product_code" name="product_code" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="name" class="form-label">Nama Produk</label>
                                <input type="text" value="{{ $item->name }}" placeholder="Nama Produk"
                                    id="name" name="name" class="form-control">
                            </div>

                            <div class="col-12">
                                <label>Gambar Yang Sudah Ada</label>
                                <br>
                                <img src="{{ asset('storage/' . $item->image) }}" style="width:200px" alt="image">
                            </div>
                            <div class="col-12">
                                <label for="image" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label">Deskripsi Produk</label>
                                <input id="description" value="{{ $item->description }}" placeholder="Deskripsi"
                                    name="description" type="text" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="price" class="form-label">Harga Produk</label>
                                <input type="text" value="{{ $item->price }}" id="price2"
                                    placeholder="Harga Produk" name="price" type="text" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="modal" class="form-label">Modal Produk</label>
                                <input type="text" value="{{ $item->capital_price }}" id="capital_price2"
                                    placeholder="Modal" name="capital_price" type="text" class="form-control">
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


    <script>
        new AutoNumeric('#price', {
            digitGroupSeparator: ',',
            decimalPlaces: 0,

        });

        new AutoNumeric('#capital_price', {
            digitGroupSeparator: ',',
            decimalPlaces: 0,

        });

        new AutoNumeric('#stock', {
            digitGroupSeparator: ',',
            decimalPlaces: 0,

        });

        new AutoNumeric('#price2', {
            digitGroupSeparator: ',',
            decimalPlaces: 0,

        });

        new AutoNumeric('#capital_price2', {
            digitGroupSeparator: ',',
            decimalPlaces: 0,

        });

        new AutoNumeric('#stock2', {
            digitGroupSeparator: ',',
            decimalPlaces: 0,

        });
    </script>

@endsection
