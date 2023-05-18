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
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 " action="{{ route('register') }}" method="post" >
                    @csrf
                    @method('post')
                    <div class="col-12">
                      <label for="yourName" class="form-label">Your Name</label>
                      <input placeholder="name" type="text" name="name" class="form-control" id="yourName">
                        @if ($errors->has('name'))
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif
                      
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input placeholder="email" type="email" name="email" class="form-control" id="yourEmail">
                        @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input placeholder="password" type="password" name="password" class="form-control" id="yourPassword">
                        @if ($errors->has('password'))
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Confirm Passowrd</label>
                      <input  placeholder="Password Confirmation" type="password" name="password_confirmation" class="form-control" id="yourPassword">
                    </div>


                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="{{ 'login' }}">Log in</a></p>
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

@endsection