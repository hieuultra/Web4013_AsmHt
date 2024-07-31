{{-- <?php
use Illuminate\Support\Facades\File;
?> --}}
@extends('layout')
@section('titlepage','Website bán hàng online LaraSu24')
@section('title','Website bán hàng online LaraSu24')

@section('content')

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script>
  $().ready(function() {
    $("#demoForm").validate({
      onfocusout: false,
      onkeyup: false,
      onclick: false,
      rules: {
        "username": {
          required: true,
        },
        "password": {
          required: true,
        },

      },
      messages: {
        "username": {
          required: "Bắt buộc nhập username ",
        },
        "password": {
          required: "Bắt buộc nhập password ",
        }
      }
    });
  });
</script>
<style>
  label.error {
    color: red;
  }

  .tbao {
    color: red;
    font-weight: 500;
    font-size: medium;
  }
</style>

<body>
  <main class="main d-flex w-100 mt-5">
    <div class="container d-flex flex-column mt-5">
      <div class="row h-100">
        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
          <div class="d-table-cell align-middle">
            <div class="text-center mt-4">
              <h1 class="h2">Welcome back</h1>
              <p class="lead">Sign in to your account to continue</p>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="m-sm-4">
                  <div class="text-center">
                    <!-- <img src="" alt="logo" class="img-fluid rounded-circle" width="132" height="132" /> -->
                    <h1 class="m-0 display-5 font-weight-semi-bold">
                      <span class="text-primary font-weight-bold border px-3 mr-1">Ultra</span>Shop
                    </h1>
                  </div>
                  <form action="{{ route('login') }}" method="post" id="demoForm">
                    @csrf
                    <div class="form-group">
                      <label>Email</label>
                      <input class="form-control form-control-lg @error('email') is-invalid @enderror " type="email" name="email"
                       placeholder="Enter your Email" value="{{ old('email') }}" autocomplete="email" />
                     @error('email')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                     @enderror
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" name="password" placeholder="Enter your password" />
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                      <div class="d-flex mt-2 justify-content-between">
                        <small>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        </small>
                        <br />
                        <small>
                          <a href="{{ route('viewRegister') }}">Create account?</a>
                        </small>
                      </div>
                    </div>
                    <div>
                      <div class="custom-control custom-checkbox align-items-center">
                        <input type="checkbox" class="custom-control-input" value="remember-me" name="remember-me" checked="" />
                        <label class="custom-control-label text-small">Remember me next time</label>
                      </div>
                    </div>
                    <div class="text-center mt-3">
                      <input type="submit" href="#" class="btn btn-lg btn-primary" value="Login" name="dangnhap">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>

@endsection
