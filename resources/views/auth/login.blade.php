@extends('layouts_login.app')
@section('content')

<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

             

              <div class="card mb-3">

                <div class="card-body">

                  

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your email & password to login</p>
                  </div>

                <form action="{{ route('login') }}" method="post" class="row g-3 " >
                    @csrf
                    @method('post')
                    @if (Session::has('error'))
                        <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Session::has('success'))
                       <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                              {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="col-12">
                        <label for="youremail" class="form-label">Email</label>
                        <input placeholder="Email" type="email" name="email" class="form-control" id="youremail" >
                        @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div class="col-12">
                        <label for="yourpassword" class="form-label">Password</label>
                        <input placeholder="Password" type="password" name="password" class="form-control" id="yourpassword" >
                        @if ($errors->has('password'))
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>

                    <div class="col-12">
                        <p class="small mb-0">Don't have account? <a href="{{ route('register') }}">Create an account</a></p>
                    </div>

                </form>

                </div>
              </div>


            </div>
          </div>
        </div>

      </section>

    </div>
</main><!-- End #main -->


</body>



@endsection