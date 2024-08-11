@extends('layout')
@section('titlepage','Website bán hàng online LaraSu24')
@section('title','Website bán hàng online LaraSu24')

@section('content')
<style>
    label.error {
        color: red;
    }

    .tbao {
        color: red;
    }
    .btn-custom {
            padding: 5px 10px; /* Điều chỉnh kích thước padding để nút nhỏ hơn */
            font-size: 12px; /* Điều chỉnh kích thước chữ để nút thon gọn hơn */
        }
</style>
<main class="main d-flex w-100 mt-5">
    <div class="container d-flex flex-column mt-5">
        <div class="row h-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="text-center mt-4">
                        <h1 class="h2">Login Sucsess</h1>
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
                                    <div class="text-center mt-4 font-weight-bold border px-3 mr-1">
                                        HELLO <br />
                                        {{ Auth::user()->name }}
                                    </div>
                                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px">
                                        <img src="{{asset('upload/'.Auth::user()->image) }}" alt="" width="400" height="200">
                                    </div>
                                    <div class="form-group">
                                            <li><a href="{{ route('orders.index') }}">My order </a></li>
                                           <li>  @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">
                                                {{ __('Forgot Password?') }}
                                            </a>
                                                @endif
                                            </li>
                                            <li> <a href="{{ route('viewEditAcc') }}">Edit account </a> </li>
                                            <li> <a href="../admin">Login admin </a></li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <li><input type="submit" class="btn btn-danger btn-custom" value="Logout"></li>
                                                {{-- <li><a href="{{ route('logout') }}">Log out </a></li> --}}
                                            </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <h2 class="tbao">
                        {{-- <?php
                        if (isset($tbao) && ($tbao) != "") {
                            echo $tbao;
                        }
                        ?> --}}
                    </h2>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
