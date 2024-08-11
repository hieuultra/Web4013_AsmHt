@extends('layout')
@section('titlepage','WEBSITE SHOPING LARASU24')
@section('title', 'Products Summer 2024')

@section('content')

<style>
    #img {
        height: 300px;
        width: 100%;
    }
</style>
<!-- Products Start -->
<div class="container-fluid pt-5">
    <!-- Title -->
    <div class="text-center mb-4">
        <h2 class="section-title px-5">
            <span class="px-2">Products</span>
        </h2>
    </div>

    <!-- Search & sort -->
    <div class="row px-xl-5 pb-3">
        <!-- Search & sort -->
        <div class="col-12 pb-1">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <!-- Search -->
                <form action="index.php?act=search_pro" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search by name" name="kyw" />
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <!-- <i class="fa fa-search"></i> -->
                                <input type="submit" class="btn btn-primary" value="SEARCH" name="search">
                            </span>
                        </div>
                    </div>
                </form>
                <!-- Sort -->
                <div class="dropdown ml-4">
                    <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort by
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                        <a class="dropdown-item" href="#">Latest</a>
                        <a class="dropdown-item" href="#">Popularity</a>
                        <a class="dropdown-item" href="#">Best Rating</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row px-xl-5 pb-3">
        <!-- Product -->
        @foreach($products as $s)
        @php $tt = $s->price - (($s->price * $s->discount) / 100); @endphp
           <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
     <div class="card product-item border-0 mb-4">
       <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
       <a href="{{ route('productDetail', $s->id) }}"><img class="img-fluid w-300" src="{{ asset('upload/'.$s->img) }}" alt="" id="img" /></a>
       </div>
       <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
         <h6 class="text-truncate mb-3">{{ $s->name }}</h6>
         <div class="d-flex justify-content-center">
           <h6>{{ number_format($tt, 0, ",", ".") }} VND</h6>
           <h6 class="text-muted ml-2"><del>{{ number_format($s->price, 0, ",", ".") }} VND</del></h6>
         </div>
       </div>
       <div class="card-footer d-flex justify-content-between bg-light border">
         <a href="{{ route('productDetail', $s->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
         <form action="{{ route('cart.addCart') }}" method="post">
            @csrf
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="productId" value="{{ $s->id }}">
            {{-- <input type="hidden" name="name" value="{{ $s->name }}">
            <input type="hidden" name="img" value="{{ $s->img }}">
            <input type="hidden" name="price" value="{{ $s->price }}"> --}}
            <button class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
          </form>
       </div>
     </div>
   </div>
    @endforeach
    </div>
</div>
<!-- Products End -->

@endsection
