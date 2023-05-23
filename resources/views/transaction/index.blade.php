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
           
              <form class="row g-3">
                <div class="col-md-3">
                  <div class="col-md-12">
                    <div class="form-floating ">
                      <input value="INV-01"  class="form-control" id="floatingInvoice" placeholder="Invoice">
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
                      <input value="Fahreza"  class="form-control" id="floatingCity" placeholder="City">
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
             <label class="display-5 d-flex justify-content-end">Rp.20,000</label>
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
            <form  action="">
              <div class="row">
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-2 " >
                      {{-- <input  class="form-control" id="inputText"> --}}
                      <div class="btn-group" role="group" aria-label="Basic example">
                          <input id="product_code" name="product_code"  class="form-control" placeholder="Kode Produk" aria-label="Kode Produk" aria-describedby="basic-addon1">
                          <button type="button" class="btn btn-primary"><i class="bi bi-search"></i></button>
                          <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                      </div>
                    </div>
                    <div class="col-2 " >
                      <input readonly  name="name"  class="form-control" placeholder="Nama Produk" aria-label="Nama Produk" aria-describedby="basic-addon1">                    

                    </div>
                    <div class="col-2 " >
                      <input readonly  class="form-control" placeholder="Kategori" aria-label="Kategori" aria-describedby="basic-addon1">                    

                    </div>
                    <div class="col-2 " >
                      <input readonly name="price"  class="form-control" placeholder="Harga" aria-label="Harga" aria-describedby="basic-addon1">                    

                    </div>
                    <div class="col-1 " >
                      <input name="qty" type="number" class="form-control" placeholder="qty" aria-label="Kategori" aria-describedby="basic-addon1">                    

                    </div>
                    <div class="col-3" >
                      <button type="button" class="btn btn-primary"><i class="bi bi-cart-plus-fill"></i> Add</button>
                      <button type="button" class="btn btn-warning"><i class="ri-restart-line"></i> Reset</button>
                    </div>
                  
                  </div>
                  
            
                  
                </div>
              </div>
            </form>
           
           
           
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
                      <tr>
                        <th scope="row">1</th>
                        <td>kdp01</td>
                        <td>Marimas</td>
                        <td>Rp. 5,000</td>
                        <td>4</td>
                        <td>Rp. 20,000</td>
                        <td><a href="" class="btn btn-sm btn-danger"> <i class="bi bi-cart-x-fill"></i> </a></td>
                      </tr>
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
                      <input name="buyer_name"  class="form-control" id="buyer_name">
                    </div>
                    <div class="col-md-12">
                      <label for="buyer_email" class="form-label">Email</label>
                      <input name="buyer_email" class="form-control" id="buyer_email">
                    </div>
                    <div class="col-md-12">
                      <label  for="buyer_phone" class="form-label">No HP</label>
                      <input name="buyer_phone"  class="form-control" id="buyer_phone">
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
                      <input name="total" readonly   class="form-control" id="total">
                    </div>
                    <div class="col-md-12">
                      <label for="cash" class="form-label">Cash</label>
                      <input name="cash"  class="form-control" id="cash">
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

<script>
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

 
@endsection