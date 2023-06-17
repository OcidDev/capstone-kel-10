@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')


    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <div class="swal2" data-swal2="{{ Session::get('success') }}">
                    </div>

                    <h5 class="card-title">Data Kategori</h5>
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
                                    <th>Nama Kategori</th>
                                    <th>Dekskripsi Kategori</th>
                                    <th>Gambar Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data_category as $item)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td> <img src="{{ Storage::url($item->image) }}" style="width:100px" alt="image">
                                        </td>
                                        <td>


                                            <form method="POST" class="d-flex" action="{{ route('category.delete', $item->id) }}">
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $item->id }}"
                                                    class="btn btn-sm btn-warning me-2">Edit</button>

                                                @csrf
                                                </a>
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
                    <h5 class="modal-title">Add Data Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('category.save') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input type="text" placeholder="Nama Kategori" id="name" name="name"
                                class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label">Deskripsi</label>
                            <input id="description" placeholder="Deskripsi" name="description" type="text"
                                class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="image" name="image">
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

    @foreach ($data_category as $item)
        <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{ route('category.edit', $item->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-12">
                                <label for="name" class="form-label">Nama Kategori</label>
                                <input type="text" value="{{ $item->name }}" placeholder="Nama Kategori"
                                    id="name" name="name" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Deskripsi</label>
                                <input id="description" value="{{ $item->description }}" placeholder="Deskripsi"
                                    name="description" type="text" class="form-control">
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
