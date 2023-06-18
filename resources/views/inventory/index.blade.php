@extends('layouts.app')
@section('title', 'Dashboard')
@section('contents')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class=" col-md-7">
                    <div class="card info-card">
                        <div class="card-title">
                        </div>
                        <div class="card-body">
                            @if (Session::get('danger'))
                                <div class="swal3" data-swal3="{{ Session::get('danger') }}">
                                </div>
                            @else
                                <div class="swal2" data-swal2="{{ Session::get('success') }}">
                                </div>
                            @endif
                            <form class="row g-3">
                                <div class="col-md-3">
                                    <div class="col-md-12">
                                        <div class="form-floating ">
                                            <input value="{{ $invoiceCode }}" class="form-control" disabled
                                                id="floatingInvoice" placeholder="Invoice">
                                            <label for="floatingInvoice">Invoice</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-md-12">
                                        <div class="form-floating ">
                                            <input value="{{ date('d M Y') }}" class="form-control" disabled
                                                id="floatingDate" placeholder="Date">
                                            <label for="floatingDate">Date</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input value="" class="form-control" disabled id="floatingJam"
                                                placeholder="Jam">
                                            <label id="jam" class="text-center" for="floatingJam">Jam</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input value="{{ Auth::user()->name }}" disabled class="form-control"
                                                id="floatingCity" placeholder="City">
                                            <label for="floatingCity">Kasir</label>
                                        </div>
                                    </div>
                                </div>
                            </form><!-- End floating Labels Form -->
                        </div>
                        <div class="card">
                        </div>
                    </div>
                </div>
                <div class=" col-md-5">
                    <div class="card info-card">
                        <div class="card-title">
                        </div>
                        <div class="card-body">
                            <label class="display-5 d-flex justify-content-end">Rp. {{ $grand_total }}</label>
                        </div>
                        <div class="card">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class=" col-md-12">
                    <div class="card info-card">
                        <div class="card-title">
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="{{ route('inventory.add_cart') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 col-md-3 ">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <div class="form-floating">
                                                        <input value="" class="form-control" id="product_code"
                                                            name="product_code" class="form-control"
                                                            placeholder="Kode Produk" aria-label="Kode Produk"
                                                            aria-describedby="basic-addon1">
                                                        <label for="product_code" class="text-center">Kode
                                                            Produk</label>
                                                    </div>
                                                    <button data-bs-toggle="modal" data-bs-target="#find-product"
                                                        type="button" class="btn btn-primary"><i
                                                            class="bi bi-search"></i>Cari</button>
                                                    <button type="reset" class="btn btn-danger"><i
                                                            class="bi bi-trash"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-2 ">
                                                <div class="form-floating">
                                                    <input value="" readonly name="product_name" class="form-control"
                                                        id="product_name" class="form-control" placeholder="Nama Produk"
                                                        aria-label="Nama Produk" aria-describedby="basic-addon1">
                                                    <label class="text-center" for="product_name">Nama
                                                        Produk</label>
                                                </div>

                                            </div>
                                            <div class="col-12 col-md-2 ">
                                                <div class="form-floating">
                                                    <input value="" readonly name="category_name"
                                                        class="form-control" id="category_name" class="form-control"
                                                        placeholder="Kategori Produk" aria-label="Kategori Produk"
                                                        aria-describedby="basic-addon1">
                                                    <label id="category_name" class="text-center"
                                                        for="category_name">Kategori Produk</label>
                                                </div>
                                            </div>
                                            <input type="hidden" readonly name="product_id" class="form-control"
                                                placeholder="ID_Produk" aria-label="Kategori"
                                                aria-describedby="basic-addon1">
                                            <div class="col-12 col-md-2 ">
                                                <div class="form-floating">
                                                    <input value="" readonly name="price" class="form-control"
                                                        id="price" class="form-control" placeholder="Harga"
                                                        aria-label="Harga" aria-describedby="basic-addon1">
                                                    <input type="hidden" id="capital_price" value="" readonly
                                                        name="capital_price">
                                                    <label id="price" class="text-center"
                                                        for="price">Harga</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-1">
                                                <div class="form-floating">
                                                    <input value="" name="qty" class="form-control"
                                                        id="qty" class="form-control" placeholder="QTY"
                                                        aria-label="QTY" aria-describedby="basic-addon1">
                                                    <label id="qty" class="text-center" for="qty">QTY</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-2 d-flex">
                                                <button type="submit"
                                                    class="btn  btn-lg mt-2 form-control btn-primary"><i
                                                        class="bi bi-cart-plus-fill"></i> Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-log-12">
            <div class="row">
                <div class=" col-md-6">
                    <div class="card info-card">
                        <div class="card">
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Harga</th>
                                                <th>Qty</th>
                                                <th>Total Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart as $item)
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>{{ $item->options->product_code }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>Rp. {{ number_format($item->price, 0) }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>Rp. {{ number_format($item->subtotal, 0) }}</td>
                                                    <td>
                                                        <form method="POST"
                                                            action="{{ route('inventory.remove_item', $item->rowId) }}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button
                                                                class="btn btn-danger btn-flat show-alert-delete-box btn-sm">
                                                                <i class="bi bi-cart-x-fill"></i>
                                                        </form>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-md-3">
                    <div class="card info-card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <form action="{{ route('inventory.save_inventory') }}" method="POST"
                                            class="row g-3">
                                            @csrf

                                            <div class="col-md-12">
                                                <label for="suppliers_id" class="form-label">Nama Supplier</label>
                                                <select class="form-select" required name="suppliers_id"
                                                    id="suppliers_id" aria-label="Default select example">
                                                    <option selected disabled>Cari Supplier</option>
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-md-3">
                    <div class="card info-card">
                        <br>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="total" class="form-label">Grand Total</label>
                                            <input value="{{ $grand_total }}" name="grand_total" readonly
                                                class="form-control" id="grand_total">
                                        </div>
                                        <div class="col-md-12">
                                            <br>
                                            <label for="cash" class="form-label">Cash</label>
                                            <input placeholder="Cash" name="cash" class="form-control"
                                                id="cash">
                                        </div>
                                        <div class="col-md-12">
                                            <br>
                                            <label for="change" class="form-label">Change</label>
                                            <input name="change" readonly class="form-control" id="change">
                                        </div>
                                        <div class="col-md-12 d-grid gap-2">
                                            <br>
                                            <button type="submit" id="pembayaran" class="btn btn-success"><i
                                                    class="bi bi-cash-stack"></i> Pembayaran</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>


                        <div class="card">

                        </div>



                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="modal fade" id="find-product" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pencarian Data Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Rak</th>
                                    <th>Gambar</th>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Deskripsi Produk</th>
                                    <th>Harga</th>
                                    <th>Modal</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
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
                                        <td> <img src="{{ Storage::url($item->image) }}" style="width:100px"
                                                alt="image">
                                        </td>
                                        <td>{{ $item->product_code }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>Rp. {{ number_format($item->price, 0) }}</td>
                                        <td>Rp. {{ number_format($item->capital_price, 0) }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <td>
                                            <button id="pilih_button_{{ $item->product_code }}" type="button"
                                                class="btn btn-success btn-xs">Pilih</button>
                                        </td>
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


    <script>
        $(document).ready(function() {

            $('#product_code').focus();


            $('#product_code').keydown(function(e) {
                let product_code = $('#product_code').val();
                if (e.keyCode == 13) {
                    e.preventDefault();
                    if (product_code == '') {
                        swal({
                            title: "Maaf !!",
                            text: 'Kode Produk Kosong',
                            icon: 'error'
                        })
                    } else {
                        CekProduk();
                    }
                }
            });

            // Hitung Kembalian
            $('#cash').keyup(function e() {
                HitungKembalian();
            });

        });


        function CekProduk() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                url: "/transaction/cek_produk",
                data: {
                    product_code: $('#product_code').val(),
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.product_name == '') {
                        swal({
                            title: "Maaf !!",
                            text: 'Kode Produk Tidak Terdaftar',
                            icon: 'error'
                        })
                    } else {
                        $('[name="product_id"]').val(response.product_id);
                        $('[name="product_name"]').val(response.product_name);
                        $('[name="category_name"]').val(response.category_name);
                        $('[name="price"]').val(response.capital_price);
                        $('[name="capital_price"]').val(response.capital_price);

                        $('#qty').focus();
                    }
                }

            });
        }

        new AutoNumeric('#cash', {
            digitGroupSeparator: ',',
            decimalPlaces: 0,
        });





        function HitungKembalian() {
            let grand_total = parseFloat($('#grand_total').val().replace(/[^.\d]/g, ''));
            let cash = parseFloat($('#cash').val().replace(/[^.\d]/g, ''));

            let change = cash - grand_total;
            if (change < 0) {
                change = 0;
            }
            $('#change').val(change);

            new AutoNumeric('#change', {
                digitGroupSeparator: ',',
            });
        }






        window.onload = function() {
            startTime();
        }

        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('jam').innerHTML = h + ':' + m + ':' + s;
            var t = setTimeout(function() {
                startTime();
            }, 500);

        }

        function checkTime(i) {
            if (i < 10) {
                i = '0' + i;
            }
            return i;
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var pilihButtons = document.querySelectorAll('[id^="pilih_button_"]');
            pilihButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var productCode = this.id.replace('pilih_button_', '');
                    document.getElementById('product_code').value = productCode;
                    var modal = document.getElementById('find-product');
                    var bootstrapModal = bootstrap.Modal.getInstance(modal);
                    bootstrapModal.hide();
                    CekProduk();
                });
            });
        });
    </script>

@endsection
