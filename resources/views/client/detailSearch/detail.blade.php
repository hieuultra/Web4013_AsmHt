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
    .input-group-btn {
            display: flex;
        }
        .btn {
            border: 1px solid #ccc;
        }
        .carousel-inner img {
    width: 100%;
    height: 800px; /* Đặt chiều cao cố định */
    object-fit: cover; /* Đảm bảo ảnh không bị kéo dài hoặc cắt bớt không đồng đều */
}

.carousel-inner img {
    width: 100%;
    height: 800px; /* Đặt chiều cao cố định */
    object-fit: cover; /* Đảm bảo ảnh không bị kéo dài hoặc cắt bớt không đồng đều */
}


  </style>

  <!-- Shop Detail Start -->
  <div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <!-- Product Carousel -->
            <div id="product-carousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                @php
                $tt = $sp['price'] - (($sp['price']  * $sp['discount']) / 100);
                     @endphp
                <div class="carousel-inner border">
                    <!-- Main Product Image -->
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('upload/' . $sp->img) }}" alt="Main Product Image" />
                    </div>

                    <!-- Variant Images -->
                    @foreach ($sp->productVariants as $variant)
                        @php
                            $imagePath = $variant->image;
                            $imageUrl = asset($imagePath);
                        @endphp
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ $imageUrl }}" alt="Variant Image" />
                        </div>
                    @endforeach
                </div>

                <!-- Carousel Controls -->
                <a class="carousel-control-prev" href="#product-carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#product-carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
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
          <small class="pt-1">{{ $sp->view }} Views</small>
        </div>
        <h3 class="font-weight-semi-bold mb-4" style="display: inline-block; margin-right: 10px;">{{ number_format($tt, 0, ",", ".")  }} $</h3>
        <h2 style="display: inline-block;"><del>{{ number_format($sp->price,0,',','.') }} $</del></h2>
<div class="">
      <p id="quantity-display">Quantity: {{ $sp->quantity }}</p>
</div>
  <!-- Size Selection -->
<div class="d-flex mb-3">
    <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
    <select class="form-select" id="size-select" name="size">
        @foreach ($sizes as $size)
            <option value="{{ $size->id }}">{{ $size->name }}</option>
        @endforeach
    </select>
</div>

   <!-- Color Selection -->
<div class="d-flex mb-4">
    <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
    <form id="color-form">
        @foreach ($colors as $color)
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="color-{{ $loop->index }}" name="color" value="{{ $color->id }}" />
                <label class="custom-control-label" for="color-{{ $loop->index }}">{{ $color->name }}</label>
            </div>
        @endforeach
    </form>
</div>

        <!-- Product Image Carousel -->
<div id="product-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" id="carousel-inner">
        <!-- Dynamic images will be inserted here by JavaScript -->
    </div>
    <a class="carousel-control-prev" href="#product-carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#product-carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

        <div class="container py-3">
            <form action="{{ route('cart.addCart') }}" method="post" class="d-flex align-items-center" id="add-to-cart-form">
                @csrf
                <div class="d-flex align-items-center me-4">
                    <h6 class="mb-0 me-2">Qty:</h6>
                    <div class="input-group" style="width: 130px;">
                        <button class="btn btn-outline-primary" type="button" id="btn-minus">
                            <i class="fa fa-minus"></i>
                        </button>
                        <input type="text" class="form-control text-center" value="1" name="quantity" id="quantity-input">
                        <button class="btn btn-outline-primary" type="button" id="btn-plus">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <input type="hidden" name="productId" value="{{ $sp->id }}">
                    <input type="hidden" name="size_id" id="selected-size-id">
                     <input type="hidden" name="color_id" id="selected-color-id">
                </div>
                <button type="submit" class="btn btn-primary ms-4">Add to Cart</button>
            </form>
        </div>

        <p>Short Description:</p>
        {{ $sp->description }}
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
              {!! $sp->content !!}
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
  <script>
    $('#size-select, input[name="color"]').on('change', function() {
        $('#selected-size-id').val($('#size-select').val());
        $('#selected-color-id').val($('input[name="color"]:checked').val());
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        function updateCarousel() {
            var sizeId = $('#size-select').val();
            var colorId = $('input[name="color"]:checked').val();

            if (sizeId && colorId) {
                $.ajax({
                    url: '{{ route('variant.details') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        size_id: sizeId,
                        color_id: colorId
                    },
                    success: function(response) {
                        var $carouselInner = $('#carousel-inner');
                        var $quantityDisplay = $('#quantity-display');

                        // Cập nhật carousel
                        $carouselInner.empty();
                        if (response.image) {
                            $carouselInner.append(`
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="${response.image}" alt="Variant Image" />
                                </div>
                            `);
                        } else {
                            $carouselInner.html('<p>No images available</p>');
                        }

                        // Cập nhật số lượng
                        $quantityDisplay.text('Quantity: ' + response.quantity);
                    }
                });
            }
        }

        $('#size-select, input[name="color"]').on('change', updateCarousel);

        // Initialize carousel on page load
        updateCarousel();
    });
</script>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity-input');
        const btnPlus = document.getElementById('btn-plus');
        const btnMinus = document.getElementById('btn-minus');

        btnPlus.addEventListener('click', function() {
            quantityInput.value = parseInt(quantityInput.value) + 1;
        });

        btnMinus.addEventListener('click', function() {
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        });
    });
    //xu ly neu nguoi dung nhap so am
    $('#quantity-input').on('change', function(){
             var value = parseInt($(this).val(), 10);
             if (isNaN(value) || value < 1) {
                 alert('Quantity must be a number >= 1')
                 $(this).val(1);
             }
    });
</script>

@endsection
