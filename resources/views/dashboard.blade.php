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
                      <h6>{{ $raks }}</h6>

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


         
          </div>
        </div>
      </div>
    </section>

 
@endsection