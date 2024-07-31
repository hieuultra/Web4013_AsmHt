@extends('admin.layout')
@section('titlepage','')

@section('content')
 <!-- Quill css -->
 <link href="{{ asset('assets/admin/libs/quill/quill.core.js') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/admin/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/admin/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />

<div class="container-fluid mt-4 px-4">
    <h1 class="mt-4">Add product</h1>
    <form action="{{ route('admin.products.productAdd') }}" method="post" enctype="multipart/form-data" id="demoForm">
        @csrf
        <div class="row">
            <!-- Phần bên trái -->
            <div class="col-lg-4">
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="Name">
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                            <option value="0">Choose categories</option>
                            @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" name="price" placeholder="Price">
                        @error('price')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Discount</label>
                        <input type="number" class="form-control @error('discount') is-invalid @enderror" value="{{ old('discount') }}" name="discount" placeholder="Discount">
                        @error('discount')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" name="quantity" placeholder="Quantity">
                        @error('quantity')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description Short</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                         placeholder="Leave a description product here" style="height: 100px" name="description" >{{ old('description') }}</textarea>
                         @error('description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <label for="is_type" class="form-label">Status:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_type" id="flexRadioDefault1" value="1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                          Display
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="is_type" id="flexRadioDefault2" value="0">
                        <label class="form-check-label" for="flexRadioDefault2">
                          Hidden
                        </label>
                    </div>

                    <label for="" class="form-label">Other Customized:</label>
                    <div class="form-switch mb-3 ps-3 d-flex justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input bg-danger" type="checkbox" name="is_new" checked>
                            <label for="is_new" class="form-check-label">NEW</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input bg-secondary" type="checkbox" name="is_hot" checked>
                            <label for="is_hot" class="form-check-label">HOT</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input bg-warning" type="checkbox" name="is_hot_deal" checked>
                            <label for="is_hot_deal" class="form-check-label">HOT DEAL</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input bg-success" type="checkbox" name="is_show_home" checked>
                            <label for="is_show_home" class="form-check-label">SHOW HOME</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Phần bên phải -->
            <div class="col-lg-8">
                <div class="row">
                    <div class="mb-3">
                        <label for="Description" class="form-check-label">Description Long</label>
                        <div id="quill-editor" style="height: 400px;">

                        </div>
                        <textarea name="content" id="nd_content" class="d-none">Enter Description Long</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="img" onchange="showImage(event)">
                        <img id="imgPro" src="" alt="Image Product" style="width:150px; display: none">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Album Image</label>
                        <table class="table align-middle table-nowrap mb-0">
                               <tbody>
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <img id="preview_0" src="https://cdn.icon-icons.com/icons2/510/PNG/512/image_icon-icons.com_50366.png"
                                        class="me-3" alt="Image Product" style="width:50px;">
                                        <input type="file" class="form-control" name="img" onchange="showImage(event)">
                                    </td>
                                    <td>
                                        <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                    </td>
                                </tr>
                               </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Add" name="them">
        <a href="{{ route('admin.products.productList') }}">
            <input type="button" class="btn btn-primary" value="LIST_PRO">
        </a>
    </form>
</div>

   <!-- Quill Editor Js -->
   <script src="{{ asset('assets/admin/libs/quill/quill.core.js') }}"></script>
   <script src="{{ asset('assets/admin/libs/quill/quill.min.js') }}"></script>

   <script>
    document.addEventListener('DOMContentLoaded', function(){
        var quill = new Quill("#quill-editor", {
            theme: "snow",
    })
    //hien thi nd cu
    var old_content = `{!! old('content') !!}`;
    quill.root.innerHTML = old_content;

    //update lai textarea an khi content quill_editor thay doi
    quill.on('text-change', function() {
        document.getElementById('nd_content').value = quill.root.innerHTML;
    });
})
   </script>
<script>
    //hien thi image khi add
    function showImage(event){
        const imgPro = document.getElementById('imgPro');
        const file =  event.target.files[0];
        const reader = new FileReader();
        reader.onload = function(){
            imgCate.src = reader.result;
            imgCate.style.display = "block";
        }
        if(file){
            reader.readAsDataURL(file);
        }
    }
  </script>
@endsection
