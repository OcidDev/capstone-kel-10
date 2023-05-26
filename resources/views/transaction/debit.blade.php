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

                    <h5 class="card-title">Transaksi Belum Lunas</h5>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Nama Customer</th>
                                <th scope="col">Daftar Produk</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $transaction->invoice_code }}</td>
                                    <td>{{ $transaction->buyer_name }}</td>
                                    <td>
                                      @foreach ($transaction->DetailTransaction as $detail )
                                        {{ $detail->product->name }}    |   {{ $detail->qty }} pcs <br>
                                      @endforeach
                                    </td>
                                    <td>Rp. {{ number_format($transaction->total,0) }}</td>
                                    <td> <span class="badge rounded-pill bg-danger">{{ $transaction->status }}</span></td>
                                    <td>
                                      <button  data-bs-toggle="modal" id="bayar" data-bs-target="#bayar{{ $transaction->id }}" style="color:white" href="#" class="btn btn-primary">
                                        Bayar
                                      </button>
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

    @foreach ($transactions as $transaction)
    <div class="modal fade" id="bayar{{ $transaction->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('status_lunas',$transaction->id) }}" method="GET">
                    @csrf
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="total" class="form-label">Grand Total</label>
                                    <input value="{{number_format($transaction->total) }}" name="grand_total" readonly   class="form-control" id="grand_total">
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <label for="cash" class="form-label">Cash</label>
                                    <input required placeholder="Cash" name="cash"  class="form-control" id="cash">
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <label for="change" class="form-label">Change</label>
                                    <input name="change" readonly  class="form-control" id="change">
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Bayar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

<script>
 

    // Hitung change
    $('#cash').keyup(function e() {
      HitungKembalian();
    });


   new AutoNumeric('#cash', {
    digitGroupSeparator : ',',
    decimalPlaces: 0,
  });

  
  

  function HitungKembalian() {
    let grand_total =$('#grand_total').val().replace(/[^.\d]/g,'').toString();
    let cash = $('#cash').val().replace(/[^.\d]/g,'').toString();

    let change = parseFloat(cash) - parseFloat(grand_total);
    $('#change').val(change);


    new AutoNumeric('#change', {
      digitGroupSeparator : ',',
      decimalPlaces: 0,
    });
  }



  
</script>



@endsection