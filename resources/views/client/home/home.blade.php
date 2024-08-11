@extends('layout')
@section('titlepage','WEBSITE SHOPING LARASU24')
@section('title','Welcome')

@section('content')
{{-- slideshow --}}
<style>
    .product-offer img {
      transition: transform 0.5s ease;
    }

    .product-offer:hover img {
      transform: scale(1.1);
    }
  </style>
  <div class="container-fluid mb-3">
    <div class="row px-xl-5">
      <div class="col-lg-8">
        <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#header-carousel" data-slide-to="1"></li>
            <li data-target="#header-carousel" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item position-relative active" style="height: 430px;">
              <img class="position-absolute w-100 h-100" src="{{ asset('img/s1.jpg') }}" style="object-fit: cover;">
              <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <div class="p-3" style="max-width: 700px;">
                  <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Men Fashion</h1>
                  <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                  <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="?act=shop1">Shop Now</a>
                </div>
              </div>
            </div>
            <div class="carousel-item position-relative" style="height: 430px;">
              <img class="position-absolute w-100 h-100" src="{{ asset('img/s2.jpg') }}" style="object-fit: cover;">
              <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <div class="p-3" style="max-width: 700px;">
                  <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Women Fashion</h1>
                  <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                  <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="?act=shop2">Shop Now</a>
                </div>
              </div>
            </div>
            <div class="carousel-item position-relative" style="height: 430px;">
              <img class="position-absolute w-100 h-100" src="{{ asset('img/s3.jpg') }}" style="object-fit: cover;">
              <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <div class="p-3" style="max-width: 700px;">
                  <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Kids Fashion</h1>
                  <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                  <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="row">
          <div class="col-md-12 mb-4">
            <div class="product-offer mb-2">
              <img class="img-fluid w-100" src="{{ asset('img/b1.jpg') }}" alt="">
              <div class="offer-text position-absolute text-center w-100">
                <h6 class="text-white text-uppercase">Save 20%</h6>
                <h3 class="text-white mb-3">Special Offer</h3>
                <a href="#" class="btn btn-primary">Shop Now</a>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="product-offer mt-2">
                <img class="img-fluid w-100" src="{{ asset('img/b_giay.jpg') }}" alt="">
                <div class="offer-text position-absolute text-center w-100">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <!-- <a href="#" class="btn btn-primary">Shop Now</a> -->
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
{{-- end slideshow --}}

   <!-- Featured Start -->
   <div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
      <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="d-flex align-items-center border mb-4" style="padding: 30px">
          <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
          <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="d-flex align-items-center border mb-4" style="padding: 30px">
          <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
          <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="d-flex align-items-center border mb-4" style="padding: 30px">
          <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
          <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="d-flex align-items-center border mb-4" style="padding: 30px">
          <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
          <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
        </div>
      </div>
    </div>
  </div>
  <!-- Featured End -->

  <!-- Categories Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        @foreach($categories as $category)
         <div class="col-lg-2 col-md-6 pb-1">
          <a class="text-decoration-none" href="">
          <div class="cat-item d-flex align-items-center mb-4">
              <div class="overflow-hidden" style="width: 100px; height: 100px;">
              <a href="{{ route('productsByCategoryId', $category->id) }}"> <img class="img-fluid" src="{{ asset('upload/'. $category->img) }}" alt=""></a>
              </div>
              <div class="flex-fill pl-3">
                  <h6>{{ $category->name }}</h6>
                  <small class="text-body">{{ $category->products_count }} Products</small>
              </div>
          </div>
      </a>
      </div>
      @endforeach
    </div>
  </div>
  <!-- Categories End -->

  <!-- Offer Start -->
<div class="container-fluid offer pt-5">
    <div class="row px-xl-5">
      <div class="col-md-6 pb-4">
        <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
          <img src="user/img/offer-1.png" alt="" />
          <div class="position-relative" style="z-index: 1">
            <h5 class="text-uppercase text-primary mb-3">
              20% off the all order
            </h5>
            <h1 class="mb-4 font-weight-semi-bold">Spring Collection</h1>
            <a href="?act=shop" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
          </div>
        </div>
      </div>
      <div class="col-md-6 pb-4">
        <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
          <img src="user/img/offer-2.png" alt="" />
          <div class="position-relative" style="z-index: 1">
            <h5 class="text-uppercase text-primary mb-3">
              20% off the all order
            </h5>
            <h1 class="mb-4 font-weight-semi-bold">Winter Collection</h1>
            <a href="?act=shop1" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Offer End -->

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
            <span class="px-2">List Products</span>
        </h2>
    </div>

    <!-- Search & sort -->
    <div class="row px-xl-5 pb-3">
        <!-- Search & sort -->
        <div class="col-12 pb-1">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <!-- Search -->
                <form action="{{ route('products.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="query" placeholder="Search by name"/>
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <!-- <i class="fa fa-search"></i> -->
                                <input type="submit" class="btn btn-primary" value="SEARCH">
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
        @foreach ($newProducts as $item)
           @php $tt = $item['price'] - (($item['price']  * $item['discount']) / 100); @endphp
             {{-- $hinh = "./app/public/image/" . $img;
             $linksp = "pro_detail&id=" . $s['id']; --}}
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <a href="{{ route('productDetail', $item->id) }}"> <img class="img-fluid w-300" src="{{ asset('upload/'.$item->img)  }}" alt="" id="img" /></a>
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <div class="product-action">
                            <form action="wishlist" method="post">
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <input type="hidden" name="name" value="{{$item->name}}">
                                <input type="hidden" name="img" value="{{$item->img}}">
                                <input type="hidden" name="price" value="{{$item->price}}">
                                {{-- <input type="hidden" name="discount" value="<?= $discount ?>"> --}}
                                <input type="submit" class="btn btn-primary" value="Like" name="wishlist">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            </form>
                        </div>
                        <a href="{{ route('productDetail', $item->id) }}">
                            <h6 class="text-truncate mb-3">{{ $item->name }}</h6>
                        </a>
                        <div class="d-flex justify-content-center">
                            <h6>{{ number_format($tt, 0, ",", ".")  }} VND  </h6>
                            <h6 class="text-muted ml-2"><del>{{ number_format($item->price,0,',','.') }} VNĐ</del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="{{ route('productDetail', $item->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <form action="addtocart" method="post">
                            <input type="hidden" name="id" value="{{$item->id}}">
                                <input type="hidden" name="name" value="{{$item->name}}">
                                <input type="hidden" name="img" value="{{$item->img}}">
                                <input type="hidden" name="price" value="{{$item->price}}">
                            <input type="submit" value="Add To Cart" class="btn btn-sm text-dark p-0" name="addtocart"><i class="fas fa-shopping-cart text-primary mr-1"></i>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</div>
<!-- Products End -->

<!-- Subscribe Start -->
<div class="container-fluid bg-secondary my-5">
    <div class="row justify-content-md-center py-5 px-xl-5">
      <div class="col-md-6 col-12 py-5">
        <div class="text-center mb-2 pb-2">
          <h2 class="section-title px-5 mb-3">
            <span class="bg-secondary px-2">SIGN UP FOR PROMOTIONS</span>
          </h2>
          <p>
            Enter your email here to receive the latest fashion trends and promotions from UMULTISHOP.
          </p>
        </div>
        <form action="">
          <div class="input-group">
            <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here" />
            <div class="input-group-append">
              <button class="btn btn-primary px-4">Subscribe</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Subscribe End -->


    {{-- <h2>Tồn kho</h2>
    <div class="product-box">
        @foreach ($instockProducts as $item)
            <div class="product">
                <img src="{{ asset('upload/'.$item->img)  }}" alt="" />
                <h3>{{$item->name}}</h3>
                <p>{{ number_format($item->price,0,',','.') }} VNĐ</p>
                @if ($item->category)
                    ({{ $item->category->name }})
                @endif
            </div>
        @endforeach
    </div> --}}

@endsection
