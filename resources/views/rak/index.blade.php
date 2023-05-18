@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')

<div class="row">
  <div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        
        <div class="swal2" data-swal2="{{ Session::get('success') }}">
        </div>
      
        <h5 class="card-title">Data Rak</h5>
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
              <th scope="col">Nama Rak</th>
              <th scope="col">Dekskripsi Rak</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @php
              $no=1;
            @endphp
            @foreach  ($data_rak as $item)
              <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>

                
                   <form method="POST" action="{{ route('rak.delete', $item->id) }}">
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
        <h5 class="modal-title">Add Data Rak</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" action="{{ route('rak.save')}}" method="POST">
          @csrf
            <div class="col-12">
              <label for="name" class="form-label">Nama Rak</label>
              <input type="text"  placeholder="Nama Rak" id="name" name="name" class="form-control" >
            </div>
            <div class="col-12">
              <label for="description"  class="form-label">Deskripsi</label>
              <input id="description"  placeholder="Deskripsi" name="description" type="text" class="form-control" >
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

@foreach  ($data_rak as $item)
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Rak</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" method="POST" action="{{ route('rak.edit',$item->id)}}" method="POST">
          @csrf
            <div class="col-12">
              <label for="name" class="form-label">Nama Rak</label>
              <input type="text" value="{{ $item->name }}" placeholder="Nama Rak" id="name" name="name" class="form-control" >
            </div>
            <div class="col-12">
              <label for="description"  class="form-label">Deskripsi</label>
              <input id="description" value="{{ $item->description }}" placeholder="Deskripsi" name="description" type="text" class="form-control" >
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