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
                      <input value="{{ $invoiceCode }}"  class="form-control" id="floatingInvoice" placeholder="Invoice">
                      <label for="floatingInvoice">Invoice</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="col-md-12">
                    <div class="form-floating ">
                      <input value="{{ date('d M Y') }}"  class="form-control" id="floatingDate" placeholder="Date">
                      <label for="floatingDate">Date</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="col-md-12">
                    <div class="form-floating">
                      <input value=""    class="form-control" id="floatingJam" placeholder="Jam">
                      <label id="jam"  class="text-center" for="floatingJam">Jam</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="col-md-12">
                    <div class="form-floating">
                      <input value="{{ Auth::user()->name }}"  class="form-control" id="floatingCity" placeholder="City">
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
             <label class="display-5 d-flex justify-content-end">Rp. {{  $grand_total }}</label>
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
                <form action="{{ route('transaction.add_cart')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-3" >
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <input required id="product_code" name="product_code"  class="form-control" placeholder="Kode Produk" aria-label="Kode Produk" aria-describedby="basic-addon1">
                          <button data-bs-toggle="modal" data-bs-target="#find-product" type="button" class="btn btn-primary"><i class="bi bi-search"></i></button>
                          <button type="reset" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                      </div>
                    </div>
                    <div class="col-2 " >
                      <input readonly  name="product_name"  class="form-control" placeholder="Nama Produk" aria-label="Nama Produk" aria-describedby="basic-addon1">                    

                    </div>
                    <div class="col-2 " >
                      <input readonly name="category_name"  class="form-control" placeholder="Kategori" aria-label="Kategori" aria-describedby="basic-addon1">                    

                    </div>
                    <div class="col-2 " >
                      <input readonly name="price"   class="form-control" placeholder="Harga" aria-label="Harga" aria-describedby="basic-addon1">                    

                    </div>
                    <div class="col-1 " >
                      <input id="qty" name="qty" type="number" class="form-control" placeholder="qty" aria-label="Kategori" aria-describedby="basic-addon1">                    

                    </div>
                    <div class="col-2" >
                      <button type="submit" class="btn btn-primary"><i class="bi bi-cart-plus-fill"></i> Add</button>
                    </div>
                  
                  </div>
                </form>
              </div>
            </div>
           
           
           
          </div>

           <div class="card">
            
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
                <div class="col-lg-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kode Produk</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                       @foreach ( $cart as $item )
                      <tr>
                        <th scope="row">1</th>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>Rp. {{ number_format($item->price,0) }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>Rp. {{ number_format($item->subtotal ,0)}}</td>
                        <td>
                          <form method="POST" action="{{ route('transaction.remove_item', $item->rowId) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger btn-flat show-alert-delete-box btn-sm"> <i class="bi bi-cart-x-fill"></i> 
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

          <div class="card">
            
          </div>

          

        </div>
      </div>
      <div class=" col-md-3">
        <div class="card info-card">
     
         

          <div class="card-body ">
              <div class="row">
                <div class="col-lg-12">
                  <div class="row">
                   <form class="row g-3">
                    <div class="col-md-12">
                      <label for="buyer_name" class="form-label">Nama Pembeli</label>
                      <input placeholder="Nama Pembeli" name="buyer_name"  class="form-control" id="buyer_name">
                    </div>
                    <div class="col-md-12">
                      <label for="buyer_email" class="form-label">Email</label>
                      <input placeholder="Email" name="buyer_email" class="form-control" id="buyer_email">
                    </div>
                    <div class="col-md-12">
                      <label  for="buyer_phone" class="form-label">No HP</label>
                      <input placeholder="No Hp" name="buyer_phone"  class="form-control" id="buyer_phone">
                    </div>
                    <div class="col-md-12">
                      <label  for="status" class="form-label">Status Pembayaran</label>
                      <select class="form-select" name="status">
                        <option selected disabled value="">Pilih Status Pembayaran</option>
                          <option value="">BELUM LUNAS</option>
                          <option value="">LUNAS</option>
                      </select>
                    </div>
                            
                      
                    </form>
                  </div>
                </div>
              </div>
          </div>

          <div class="card">
            
          </div>

          

        </div>
      </div>
       <div class=" col-md-3">
        <div class="card info-card">
     
         

          <div class="card-body ">
              <div class="row">
                <div class="col-lg-12">
                  <div class="row">
                   <form class="row g-3">
                    <div class="col-md-12">
                      <label for="total" class="form-label">Grand Total</label>
                      <input value="{{($grand_total) }}" name="grand_total" readonly   class="form-control" id="grand_total">
                    </div>
                    <div class="col-md-12">
                      <label for="cash" class="form-label">Cash</label>
                      <input placeholder="Cash" name="cash"  class="form-control" id="cash">
                    </div>
                    <div class="col-md-12">
                      <label for="change" class="form-label">Change</label>
                      <input name="change" readonly  class="form-control" id="change">
                    </div>
                    <div class="col-md-12 d-grid gap-2 mt-3">
                      <button type="button" class="btn btn-success"><i class="bi bi-cash-stack"></i> Pembayaran</button>
                    </div>
                      

                      
                    </form>
                  </div>
                </div>
              </div>
          </div>

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
                           <button id="pilih_button_{{ $item->product_code }}" type="button" class="btn btn-success btn-xs">Pilih</button>
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


<script>

  $(document).ready(function() {

    $('#product_code').focus();

  
    $('#product_code').keydown(function (e) {
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
        }else{
          $('[name="product_name"]').val(response.product_name);
          $('[name="category_name"]').val(response.category_name);
          $('[name="price"]').val(response.price);
          
          $('#qty').focus();
        }
      }

    });
  }

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





  window.onload = function() {
    startTime();
  }

  function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m= checkTime(m);
    s= checkTime(s);
    document.getElementById('jam').innerHTML = h + ':' + m + ':' + s;
    var t = setTimeout(function(){
      startTime();
    },500);
   
  }
   
  function checkTime(i) {
    if (i<10) {
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