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
                    @foreach ( $errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif
          <nav class="d-flex justify-content-end">
            <button data-bs-toggle="modal" data-bs-target="#add" type="button" class="btn btn-primary btn-sm">Add</button>
          </nav>

        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Kategori</th>
              <th scope="col">Supplier</th>
              <th scope="col">Rak</th>
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
              $no=1;
            @endphp
            @foreach  ($data_products as $item)
              <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{ $item->category->name }}</td>
                <td>{{ $item->supplier->name }}</td>
                <td>{{ $item->rak->name }}</td>
                <td>{{ $item->product_code }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>Rp. {{ number_format($item->price,0)}}</td>
                <td>Rp. {{ number_format($item->modal,0)}}</td>
                <td>{{ $item->stock }}</td>
                <td>
                   <form method="POST" action="{{ route('product.delete', $item->id) }}">
                      <button type="button" data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}" class="btn btn-sm btn-warning">Edit</button>

                    @csrf
                      </a>
                      <input name="_method" type="hidden" value="DELETE">
                      <button type="submit" class="btn btn-danger btn-flat show-alert-delete-box btn-sm" data-toggle="tooltip" title='Delete'>Delete</button>
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
        <form class="row g-3" action="{{ route('product.save')}}" method="POST">
          @csrf
          <div class="col-12">
            <label  class="form-label">Kategori Produk</label>
            <select  class="form-select"  name="categories_id">
              <option selected disabled value="" >Pilih Kategori Produk</option>
              @foreach ($data_category as $item)
              <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
            </select>            
          </div>
          <div class="col-12">
            <label  class="form-label" >Supplier Produk</label>
            <select  class="form-select" name="suppliers_id">
              <option disabled value="" selected>Pilih Supllier Produk</option>
              @foreach ($data_supplier as $item)
              <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
            </select>            
          </div>
          <div class="col-12">
            <label  class="form-label" >Rak Produk</label>
            <select  class="form-select" name="raks_id">
              <option disabled value="" selected>Pilih Rak Produk</option>
              @foreach ($data_rak as $item)
              <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
            </select>            
          </div>
            <div class="col-12">
            <label for="product_code" class="form-label">Kode Produk</label>
            <input type="text"  placeholder="Kode Produk" id="product_code" name="product_code" class="form-control" >
          </div>
          <div class="col-12">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text"  placeholder="Nama Produk" id="name" name="name" class="form-control" >
          </div>
          <div class="col-12">
            <label for="description"  class="form-label">Deskripsi Produk</label>
            <input id="description"  placeholder="Deskripsi" name="description" type="text" class="form-control" >
          </div>
          <div class="col-12">
            <label for="price"  class="form-label">Harga Produk</label>
            <input type="number" id="price"  placeholder="Harga Produk" name="price" type="text" class="form-control" >
          </div>
          <div class="col-12">
            <label for="modal"  class="form-label">Modal Produk</label>
            <input type="number" id="modal"  placeholder="Modal" name="modal" type="text" class="form-control" >
          </div>
          <div class="col-12">
            <label for="stock"  class="form-label">Stok Produk</label>
            <input type="number" id="stock"  placeholder="stock" name="stock" type="text" class="form-control" >
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

@foreach  ($data_products as $item)
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" method="POST" action="{{ route('product.edit',$item->id)}}" method="POST">
          @csrf
          <div class="col-12">
            <label  class="form-label">Kategori Produk</label>
            <select  class="form-select"  name="categories_id">
              @foreach ($data_category as $item_c)
              <option value="{{$item_c->id}}"{{$item->categories_id == $item_c->id ? 'Selected' : ''}}>{{$item_c->name}}</option>
              @endforeach
            </select>            
          </div>
          <div class="col-12">
            <label  class="form-label" >Supplier Produk</label>
            <select  class="form-select" name="suppliers_id">
              @foreach ($data_supplier as $item_s)
              <option value="{{$item_s->id}}"{{$item->suppliers_id == $item_s->id ? 'Selected' : ''}}>{{$item_s->name}}</option>
              @endforeach
            </select>            
          </div>
           <div class="col-12">
            <label  class="form-label" >Rak Produk</label>
            <select  class="form-select" name="raks_id">
              @foreach ($data_rak as $item_r)
              <option value="{{$item_r->id}}"{{$item->raks_id == $item_r->id ? 'Selected' : ''}}>{{$item_r->name}}</option>
              @endforeach
            </select>            
          </div>
        
          <div class="col-12">
            <label for="product_code" class="form-label">Kode Produk</label>
            <input type="text" value="{{ $item->product_code }}"  placeholder="Kode Produk" id="product_code" name="product_code" class="form-control" >
          </div>
          <div class="col-12">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" value="{{ $item->name }}"  placeholder="Nama Produk" id="name" name="name" class="form-control" >
          </div>
          <div class="col-12">
            <label for="description"  class="form-label">Deskripsi Produk</label>
            <input id="description"  value="{{ $item->description }}"  placeholder="Deskripsi" name="description" type="text" class="form-control" >
          </div>
          <div class="col-12">
            <label for="price"  class="form-label">Harga Produk</label>
            <input type="number"  value="{{ $item->price }}" id="price"  placeholder="Harga Produk" name="price" type="text" class="form-control" >
          </div>
          <div class="col-12">
            <label for="modal"  class="form-label">Modal Produk</label>
            <input type="number"  value="{{ $item->modal }}" id="modal"  placeholder="Modal" name="modal" type="text" class="form-control" >
          </div>
          <div class="col-12">
            <label for="stock"  class="form-label">Stok Produk</label>
            <input type="number"  value="{{ $item->stock }}" id="stock"  placeholder="stock" name="stock" type="text" class="form-control" >
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