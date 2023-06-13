@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')

    <section class="section dashboard">
        <div class="row">
            <div class="swal2" data-swal2="{{ Session::get('success') }}">

            <!-- Left side columns -->
            <div class="col-lg-6">
                <div class="card">
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
                    <div class="card-body pt-3">
                        <form class="row g-3" method="POST" action="{{ route('user.edit', $profile->id) }}" method="POST">
                            @csrf
                            <div class="col-12">
                                <label for="name" class="form-label">Nama Ppengguna</label>
                                <input type="text" value="{{ $profile->name }}" placeholder="Nama Rak" id="name"
                                    name="name" class="form-control">
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">email</label>
                                <input id="email" value="{{ $profile->email }}" placeholder="email" name="email"
                                    type="email" class="form-control">
                            </div>

                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" placeholder="password" name="password" type="password"
                                    class="form-control">
                                <small class="text-muted"> *Kosongkan jika tidak ingin mengubah password</small>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
