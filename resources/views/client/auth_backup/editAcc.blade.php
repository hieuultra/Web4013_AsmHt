@extends('layout')
@section('titlepage','Website bán hàng online LaraSu24')
@section('title','Website bán hàng online LaraSu24')

@section('content')

<main class="main d-flex w-100 mt-5">
    <div class="container d-flex flex-column">
        <div class="row h-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="text-center mt-4">
                        <h1 class="h2">Edit Account</h1>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-4">
                                <form action="{{ route('editAcc') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                        <label>Username</label>
                                        <input class="form-control form-control-lg" type="text" name="username" value=" {{ Auth::user()->username }}" />
                                        <label>Password</label>
                                        <input class="form-control form-control-lg" type="password" name="password" value=" {{ Auth::user()->password }}" />
                                        <label>Name</label>
                                        <input class="form-control form-control-lg" type="text" name="name" value=" {{ Auth::user()->name }}" />
                                        <label>Address</label>
                                        <input class="form-control form-control-lg" type="text" name="address" value=" {{ Auth::user()->address }}" />
                                        <label>Phone</label>
                                        <input class="form-control form-control-lg" type="text" name="phone" value=" {{ Auth::user()->phone }}" />
                                        <label>Email</label>
                                        <input class="form-control form-control-lg" type="email" name="email" value=" {{ Auth::user()->email }}" />
                                        <label>Image</label>
                                        <input class="form-control form-control-lg" type="file" name="image" value="" />
                                        <img src="{{asset('upload/'.Auth::user()->image) }}" alt="" height="160" width="200">
                                    </div>
                                    <div class="text-center mt-3">
                                        <input type="submit" href="#" class="btn btn-lg btn-primary" value="Edit" name="edit">
                                        <!-- <button type="submit" class="btn btn-lg btn-primary">Reset password</button> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div style="color: red;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
