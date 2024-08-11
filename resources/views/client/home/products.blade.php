@extends('layout')
@section('titlepage','WEBSITE SHOPING HIEUULTRA')
@section('title', 'List Products')

@section('content')>
<style>
    #img {
      height: 300px;
      width: 100%;
    }
  </style>
  <!-- Shop Start -->
  <div class="container-fluid pt-5">
    <div class="row px-xl-5">
      <!-- Shop Sidebar Start -->
      <div class="col-lg-3 col-md-12">
        <!-- Price Start -->

        <div class="border-bottom mb-4 pb-4">
          <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
          <form action="index.php?act=filter" method="post">
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
              <input type="checkbox" class="custom-control-input" checked id="price-all" />
              <label class="custom-control-label" for="price-all">All Price</label>
              <span class="badge border font-weight-normal">1000</span>
            </div>
            <div class="row">
              <div class="col-12">
                <select class="form-select form-select-sm" name="filter" aria-label="Small select example">
                  <option value="0" selected>Choosen price</option>
                  <option value="1">0$ - 10.000$</option>
                  <option value="2">10.000$- 20.000$</option>
                  <option value="3">20.000$ - 50.000$</option>
                  <option value="4">50.000$ - 100.000$</option>
                  <option value="5"> > 100.000$</option>
                </select>
                <input type="submit" name="btnsearch" class="btn btn-primary" value="Filter" />
              </div>
            </div>
          </form>
        </div>
        <!-- Price End -->
        <!-- Color Start -->
        <div class="border-bottom mb-4 pb-4">
          <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
          <form>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
              <input type="checkbox" class="custom-control-input" checked id="color-all" />
              <label class="custom-control-label" for="price-all">All Color</label>
              <span class="badge border font-weight-normal">1000</span>
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
              <input type="checkbox" class="custom-control-input" id="color-1" />
              <label class="custom-control-label" for="color-1">Black</label>
              <span class="badge border font-weight-normal">150</span>
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
              <input type="checkbox" class="custom-control-input" id="color-2" />
              <label class="custom-control-label" for="color-2">White</label>
              <span class="badge border font-weight-normal">295</span>
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
              <input type="checkbox" class="custom-control-input" id="color-3" />
              <label class="custom-control-label" for="color-3">Red</label>
              <span class="badge border font-weight-normal">246</span>
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
              <input type="checkbox" class="custom-control-input" id="color-4" />
              <label class="custom-control-label" for="color-4">Blue</label>
              <span class="badge border font-weight-normal">145</span>
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
              <input type="checkbox" class="custom-control-input" id="color-5" />
              <label class="custom-control-label" for="color-5">Green</label>
              <span class="badge border font-weight-normal">168</span>
            </div>
          </form>
        </div>
        <!-- Color End -->

        <!-- Size Start -->
        <div class="mb-5">
          <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
          <form>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
              <input type="checkbox" class="custom-control-input" checked id="size-all" />
              <label class="custom-control-label" for="size-all">All Size</label>
              <span class="badge border font-weight-normal">1000</span>
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
              <input type="checkbox" class="custom-control-input" id="size-1" />
              <label class="custom-control-label" for="size-1">XS</label>
              <span class="badge border font-weight-normal">150</span>
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
              <input type="checkbox" class="custom-control-input" id="size-2" />
              <label class="custom-control-label" for="size-2">S</label>
              <span class="badge border font-weight-normal">295</span>
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
              <input type="checkbox" class="custom-control-input" id="size-3" />
              <label class="custom-control-label" for="size-3">M</label>
              <span class="badge border font-weight-normal">246</span>
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
              <input type="checkbox" class="custom-control-input" id="size-4" />
              <label class="custom-control-label" for="size-4">L</label>
              <span class="badge border font-weight-normal">145</span>
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
              <input type="checkbox" class="custom-control-input" id="size-5" />
              <label class="custom-control-label" for="size-5">XL</label>
              <span class="badge border font-weight-normal">168</span>
            </div>
          </form>
        </div>
        <!-- Size End -->
      </div>
      <!-- Shop Sidebar End -->

      <!-- Shop Product Start -->
      <div class="col-lg-9 col-md-12">
        <div class="row pb-3">
          <!-- Search & sort -->
          <div class="col-12 pb-1">
            <div class="d-flex align-items-center justify-content-between mb-4">
              <!-- Search -->
              <form action="{{ route('products.search') }}" method="GET">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search by name" name="query" />
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

          <!-- Product -->

          {{-- <?php if (isset($locgia) && is_array($locgia)) {
            // extract($locgia);
            //  $tt = $price - (($price * $discount) / 100);
            //  $hinh = $img_path . $img;
          ?> --}}
            {{-- <?php foreach ($locgia as $value) :  $linksp = "index.php?act=pro_detail&id_pro=" . $value['id_pro']; ?> --}}
            @foreach($products as $item)
            @php $tt = $item['price'] - (($item['price']  * $item['discount']) / 100); @endphp
              <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                  <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <a href="{{ route('productDetail', $item->id) }}"><img class="img-fluid w-300" src="{{ asset('upload/'.$item->img)  }}" alt="" id="img" /></a>
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
                      <h6>
                        {{ number_format($tt, 0, ",", ".")  }} $
                      </h6>
                      <h6 class="text-muted ml-2"><del>{{ number_format($item->price,0,',','.') }} $</del></h6>
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
                    <form action="{{ route('cart.addCart') }}" method="post">
                        @csrf
                            <input type="hidden" name="quantity" value="1">
                           <input type="hidden" name="productId" value="{{ $item->id }}">
                        <input type="submit" value="Add To Cart" class="btn btn-sm text-dark p-0" name="addtocart"><i class="fas fa-shopping-cart text-primary mr-1"></i>
                    </form>
                  </div>
                </div>
              </div>
        @endforeach
            {{-- <?php endforeach; ?> --}}
          {{-- <?php } else {; ?>
            <?php if (isset($sps) && is_array($sps)) { ?>
              <?php
              foreach ($sps as $s) {
                extract($s);
                $linksp = "index.php?act=pro_detail&id_pro=" . $id_pro;
                $tt = $price - (($price * $discount) / 100);
                $hinh = $img_path . $img;
                echo '<div class="col-lg-3 col-md-6 col-sm-12 pb-1">
       <div class="card product-item border-0 mb-4">
         <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
         <a href="' . $linksp . '">   <img class="img-fluid w-300" src="' . $hinh . '" alt="" id="img" /></a>
         </div>
         <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">

         <div class="product-action">
         <form action="index.php?act=wishlist" method="post">
           <input type="hidden" name="id_pro" value="' . $id_pro . '">
           <input type="hidden" name="name_pro" value="' . $name_pro . '">
           <input type="hidden" name="img" value="' . $img . '">
           <input type="hidden" name="price" value="' . $price . '">
           <input type="hidden" name="discount" value="' . $discount . '">
           <input type="submit" class="btn btn-primary" value="Like" name="wishlist">
         <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
         </form>
     </div>

          <a href="' . $linksp . '"> <h6 class="text-truncate mb-3">' . $name_pro . '</h6></a>
           <div class="d-flex justify-content-center">
             <h6>' . number_format($tt, 0, ",", ".") . '$' . '</h6>
             <h6 class="text-muted ml-2"><del>' . number_format($price, 0, ",", ".") . '$' . '</del></h6>
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
           <a href="' . $linksp . '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
           <form action="index.php?act=addtocart" method="post">
           <input type="hidden" name="id_pro" value="' . $id_pro . '">
           <input type="hidden" name="name_pro" value="' . $name_pro . '">
           <input type="hidden" name="img" value="' . $img . '">
           <input type="hidden" name="price" value="' . $price . '">
           <input type="hidden" name="discount" value="' . $discount . '">
           <input type="submit" value="Add To Cart" class="btn btn-sm text-dark p-0" name="addtocart"><i class="fas fa-shopping-cart text-primary mr-1"></i>
         </form>
         </div>
       </div>
     </div>';
              } ?>
            <?php } else { ?>
              <div class="row">
                <h2 style="text-align: center;">No products in a choosen</h2>
              </div>

            <?php } ?>
          <?php } ?> --}}

          <div class="col-12 pb-1">
            <nav aria-label="Page navigation">
                 <!-- Kiểm tra nếu đang ở trang đầu tiên -->
                <ul class="pagination justify-content-center mb-3">
                    @if ($products->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                    @endif

                     <!-- Tạo các liên kết trang -->
                    @foreach ($products->links()->elements[0] as $page => $url)
                        @if ($page == $products->currentPage())
                            <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                      <!-- Kiểm tra nếu còn trang sau -->
                    @if ($products->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>

        </div>
      </div>
      <!-- Shop Product End -->
    </div>
  </div>
  <!-- Shop End -->

@endsection
