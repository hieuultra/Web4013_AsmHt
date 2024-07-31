@extends('layout')
@section('titlepage','WEBSITE SHOPING LARASU24')
@section('title', 'Welcome')

@section('content')

<style>
    #img {
      height: 300px;
      width: 100%;
    }

    h2 {
      color: red;
    }

    .product-details {
      display: flex;
      align-items: center;
    }

    .like-form {
      margin-left: auto;
      /* Đẩy form sang bên phải */
    }
  </style>
  <!-- Shop Detail Start -->
  <div class="container-fluid py-5">
    <div class="row px-xl-5">
      <div class="col-lg-5 pb-5">
        <!-- List img -->
        <div id="product-carousel" class="carousel slide" data-ride="carousel">
      @php
          $tt = $sp['price'] - (($sp['price']  * $sp['discount']) / 100);
      @endphp
           <div class="carousel-inner border">
          <div class="carousel-item active">
            <img class="w-100 h-100" src="{{ asset('upload/'.$sp->img)  }}" id="x" />
          </div>
          <div class="carousel-item">
            <img class="w-100 h-100" src="{{ asset('upload/'.$sp->img)  }}" alt="Image" />
          </div>
          <div class="carousel-item">
            <img class="w-100 h-100" src="{{ asset('upload/'.$sp->img)  }}" id="x" />
          </div>
          <div class="carousel-item">
            <img class="w-100 h-100" src="{{ asset('upload/'.$sp->img)  }}" id="x" />
          </div>
        </div>

          <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
            <i class="fa fa-2x fa-angle-left text-dark"></i>
          </a>
          <a class="carousel-control-next" href="#product-carousel" data-slide="next">
            <i class="fa fa-2x fa-angle-right text-dark"></i>
          </a>
        </div>
      </div>

      <!-- Product information -->
      <div class="col-lg-7 pb-5">
        <div class="product-details">
          <h3 class="font-weight-semi-bold">{{ $sp->name }}</h3>

        </div>
        <div class="d-flex mb-3">
          <div class="text-primary mr-2">
            <small class="fas fa-star"></small>
            <small class="fas fa-star"></small>
            <small class="fas fa-star"></small>
            <small class="fas fa-star-half-alt"></small>
            <small class="far fa-star"></small>
          </div>
          <small class="pt-1">(50 Reviews)</small>
        </div>
        <h3 class="font-weight-semi-bold mb-4"> {{ number_format($tt, 0, ",", ".")  }} VND</h3>
        <p class="mb-4">
        <h2><del>{{ number_format($sp->price,0,',','.') }} VNĐ</del></h2>

        </p>

        <!-- Size -->
        <div class="d-flex mb-3">
          <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
          <select class="form-select" name="id_size">
            {{-- <?php
            if (isset($dss)) {
              foreach ($dss as $ds) {
                if ($ds['id_size'] == $id_size) $s = "selected";
                else $s = "";
                echo ' <div class="custom-control custom-radio custom-control-inline">
                <option value="' . $ds['id_size'] . '" ' . $s . '>' . $ds['name_size'] . '</option>
              </div>';
              }
            } else {
              // Xử lý khi biến $dss chưa được khởi tạo
            }
            ?> --}}
            <!-- <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="size-2" name="size" />
              <label class="custom-control-label" for="size-2">S</label>
            </div> -->
          </select>
        </div>

        <!-- Color -->
        <div class="d-flex mb-4">
          <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
          <form>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="color-1" name="color" />
              <label class="custom-control-label" for="color-1">Black</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="color-2" name="color" />
              <label class="custom-control-label" for="color-2">White</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="color-3" name="color" />
              <label class="custom-control-label" for="color-3">Red</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="color-4" name="color" />
              <label class="custom-control-label" for="color-4">Blue</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="color-5" name="color" />
              <label class="custom-control-label" for="color-5">Green</label>
            </div>
          </form>
        </div>
        <div class="d-flex align-items-center mb-4 pt-2">
          <div class="input-group quantity mr-3" style="width: 130px">
            <div class="input-group-btn">
              <button class="btn btn-primary btn-minus">
                <i class="fa fa-minus"></i>
              </button>
            </div>
            <input type="text" class="form-control bg-secondary text-center" value="1" />
            <div class="input-group-btn">
              <button class="btn btn-primary btn-plus">
                <i class="fa fa-plus"></i>
              </button>
            </div>
          </div>
          <form action="addtocart" method="post">
            <input type="hidden" name="id" value="{{$sp->id}}">
                <input type="hidden" name="name" value="{{$sp->name}}">
                <input type="hidden" name="img" value="{{$sp->img}}">
                <input type="hidden" name="price" value="{{$sp->price}}">
            <input type="submit" value="Add To Cart" class="btn btn-sm text-dark p-0" name="addtocart"><i class="fas fa-shopping-cart text-primary mr-1"></i>
        </form>
          <!-- <a href="?act=addtocart"> <button class="btn btn-primary px-3">
              <i class="fa fa-shopping-cart mr-1"></i> Add To Cart
            </button></a> -->
        </div>
        <div class="d-flex pt-2">
          <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
          <div class="d-inline-flex">
            <a class="text-dark px-2" href="">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a class="text-dark px-2" href="">
              <i class="fab fa-twitter"></i>
            </a>
            <a class="text-dark px-2" href="">
              <i class="fab fa-linkedin-in"></i>
            </a>
            <a class="text-dark px-2" href="">
              <i class="fab fa-pinterest"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Description & Review -->
    <div class="row px-xl-5">
      <div class="col">
        <div class="nav nav-tabs justify-content-center border-secondary mb-4">
          <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
          <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews</a>
        </div>
        <div class="tab-content">

          <!-- Description -->
          <div class="tab-pane fade show active" id="tab-pane-1">
            <h4 class="mb-3">Product Description</h4>
            <p>
              {{ $sp->description }}
            </p>
          </div>

          <!-- Review -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
          <script>
            $(document).ready(function() {
              $("#tab-pane-3").load("user/comment/comment_form.php", {
                id: {{$sp->id }}
              });
            });
          </script>
          <div class="tab-pane fade" id="tab-pane-3">

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Shop Detail End -->

<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
      <h2 class="section-title px-5">
        <span class="px-2">You May Also Like</span>
      </h2>
    </div>
    <div class="row px-xl-5">
      @foreach($splq as $s)
      @php $tt = $s->price - (($s->price * $s->discount) / 100); @endphp

      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card product-item border-0">
          <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
            <a href="{{ route('productDetail', $s->id) }}"><img class="img-fluid w-100" src="{{ asset('upload/'.$s->img) }}" alt="" id="img" /></a>
          </div>
          <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
            <a href="{{ route('productDetail', $s->id) }}"><h6 class="text-truncate mb-3">{{ $s->name }}</h6></a>
            <div class="d-flex justify-content-center">
              <h6>{{ number_format($tt, 0, ",", ".") }} VND</h6>
              <h6 class="text-muted ml-2"><del>{{ number_format($s->price, 0, ',', '.') }} VNĐ</del></h6>
            </div>
          </div>
          <div class="card-footer d-flex justify-content-between bg-light border">
            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
            <form action="addtocart" method="post">
              @csrf
              <input type="hidden" name="id" value="{{ $s->id }}">
              <input type="hidden" name="name" value="{{ $s->name }}">
              <input type="hidden" name="img" value="{{ $s->img }}">
              <input type="hidden" name="price" value="{{ $s->price }}">
              <button type="submit" class="btn btn-sm text-dark p-0" name="addtocart"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <!-- Products End -->


@endsection
