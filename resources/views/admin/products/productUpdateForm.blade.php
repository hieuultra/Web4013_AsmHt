@extends('admin.layout')
@section('titlepage','')
@section('content')

<div class="container-fluid mt-4 px-4">
    <h1 class="mt-4">Update product</h1>
    <form action="{{ route('admin.products.productUpdate') }}" method="post" enctype="multipart/form-data" id="demoForm">
        @csrf
        <input type="hidden" name="id" value="{{ $product->id }}">
      <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="{{ $product->name}}">
      </div>

      <div class="mb-3">
        <label class="form-label">Category</label>
        <select class="form-select" name="category_id">
            <option value="0">Choose categories</option>
            @foreach ($categories as $item)
            @if ($item->id == $product->category_id)
                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
            @else
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endif
            @endforeach
        </select>
      </div>

      {{-- <div class="mb-3">
        <label class="form-label">Brands</label>
        <select class="form-select" name="id_brand">
          <?php
          foreach ($dsbr as $ds) {
            extract($ds);
            echo '<option value="' . $id_brand . '">' . $name_brand . '</option>';
          }
          ?>

        </select>
      </div> --}}

      <div class="mb-3">
        <label class="form-label">Image</label>
        <input type="file" class="form-control" name="img">
        <img src="{{ asset('upload/'.$product->img)}}" width="120" height="100" alt="">
      </div>

      {{-- <div class="mb-3">
        <label class="form-label">Thumbnail</label>
        <input type="file" class="form-control" name="thum">
      </div> --}}

      <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" class="form-control" name="price" value="{{ $product->price}}">
      </div>

      <div class="mb-3">
        <label class="form-label">Discount</label>
        <input type="number" class="form-control" name="discount" value="{{ $product->discount}}">
      </div>

      <div class="mb-3">
        <label class="form-label">Quantity</label>
        <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}">
      </div>

      <!-- <div class="mb-3">
        <label class="form-label">ID_Size</label>
        <input type="number" class="form-control" name="size">
      </div> -->

      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" placeholder="Leave a description product here" style="height: 100px" name="description" >{{ $product->description}}</textarea>
      </div>
      <input type="submit" class="btn btn-primary" value="Update" name="update">
      <a href="{{ route('admin.products.productList') }}">
        <input type="button" class="btn btn-primary" value="LIST_PRO">
      </a>
    </form>
  </div>

@endsection
