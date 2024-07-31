<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Dashboard</title>
<!-- Thêm thư viện Chart.js từ CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Thêm thư viện DataTables từ CDN -->
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('layoutAdmin/css/styles2.css') }}">
</head>
<body>
<header>
    <h1>@yield('titlepage')</h1>
</header>

@include('admin.header')

<div id="layoutSidenav">
 <!-- Left menu -->
 <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('admin') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    Dashboard
                </a>

                <!--  -->
                <div class="sb-sidenav-menu-heading">Interface</div>

                <!-- Category -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCate" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-columns"></i>
                    </div>
                    Category
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="fas fa-angle-down"></i>
                    </div>
                </a>

                <div class="collapse" id="collapseCate" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.category.categoryList') }}">List categories</a>
                        <a class="nav-link" href="{{ route('admin.category.viewCateAdd') }}">Add categories</a>
                    </nav>
                </div>

                <!-- Product -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-columns"></i>
                    </div>
                    Product
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="fas fa-angle-down"></i>
                    </div>
                </a>

                <div class="collapse" id="collapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.products.productList') }}">List product</a>
                        <a class="nav-link" href="{{ route('admin.products.viewProAdd') }}">Add product</a>
                    </nav>
                </div>

                <!-- back to web -->
                <a class="nav-link collapsed" href="{{ route('home') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-columns"></i>
                    </div>
                    Back Website
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="fas fa-angle-down"></i>
                    </div>
                </a>

                   <!-- account -->
    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAccount" aria-expanded="false" aria-controls="collapseLayouts">
        <div class="sb-nav-link-icon">
          <i class="fas fa-columns"></i>
        </div>
        Account
        <div class="sb-sidenav-collapse-arrow">
          <i class="fas fa-angle-down"></i>
        </div>
      </a>

      <div class="collapse" id="collapseAccount" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
          <a class="nav-link" href="?act=list_account">List account</a>
          <a class="nav-link" href="?act=add_acc">Add account</a>
        </nav>
      </div>

      <!-- blog -->
      <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsebl" aria-expanded="false" aria-controls="collapseLayouts">
        <div class="sb-nav-link-icon">
          <i class="fas fa-columns"></i>
        </div>
        Blog
        <div class="sb-sidenav-collapse-arrow">
          <i class="fas fa-angle-down"></i>
        </div>
      </a>

      <div class="collapse" id="collapsebl" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
          <a class="nav-link" href="?act=list_blog">List Blog</a>
          <a class="nav-link" href="?act=add_blog">Add Blog</a>
        </nav>
      </div>


      <!-- brand -->
      <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBrand" aria-expanded="false" aria-controls="collapseLayouts">
        <div class="sb-nav-link-icon">
          <i class="fas fa-columns"></i>
        </div>
        Brand
        <div class="sb-sidenav-collapse-arrow">
          <i class="fas fa-angle-down"></i>
        </div>
      </a>

      <div class="collapse" id="collapseBrand" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
          <a class="nav-link" href="?act=list_brand">List Brand</a>
          <a class="nav-link" href="?act=add_brand">Add Brand</a>
        </nav>
      </div>


      <!-- comment -->
      <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseComment" aria-expanded="false" aria-controls="collapseLayouts">
        <div class="sb-nav-link-icon">
          <i class="fas fa-columns"></i>
        </div>
        Comment
        <div class="sb-sidenav-collapse-arrow">
          <i class="fas fa-angle-down"></i>
        </div>
      </a>

      <div class="collapse" id="collapseComment" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
          <a class="nav-link" href="?act=list_com">List Comment</a>
        </nav>
      </div>
      <!-- feedback -->
      <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsefb" aria-expanded="false" aria-controls="collapseLayouts">
        <div class="sb-nav-link-icon">
          <i class="fas fa-columns"></i>
        </div>
        Feedback
        <div class="sb-sidenav-collapse-arrow">
          <i class="fas fa-angle-down"></i>
        </div>
      </a>

      <div class="collapse" id="collapsefb" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
          <a class="nav-link" href="?act=list_fb">List Feedback</a>
        </nav>
      </div>

      <!-- bill -->
      <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsebill" aria-expanded="false" aria-controls="collapseLayouts">
        <div class="sb-nav-link-icon">
          <i class="fas fa-columns"></i>
        </div>
        Bill
        <div class="sb-sidenav-collapse-arrow">
          <i class="fas fa-angle-down"></i>
        </div>
      </a>

      <div class="collapse" id="collapsebill" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
          <a class="nav-link" href="?act=list_bill">List Bill</a>
        </nav>
      </div>
            </div>
    </nav>
</div>
<div id="layoutSidenav_content">
    <main>
        @yield('content')
     </main>
     @include('admin.footer')
</div>
</div>



 <!-- Js -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
 <script src="{{ asset('layoutAdmin/js/scripts.js') }}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
 <script src="{{ asset('layoutAdmin/asset/chart-area-demo.js') }}"></script>
 <script src="{{ asset('layoutAdmin/asset/chart-bar-demo.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
 <script src="{{ asset('layoutAdmin/js/datatables-simple-demo.js') }}"></script>
</body>
</html>
