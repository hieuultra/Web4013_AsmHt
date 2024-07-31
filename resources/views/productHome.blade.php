<?php
use Illuminate\Support\Facades\File;
?>
@extends('layout')
@section('titlepage','Website bán hàng online LaraSu24')
@section('title','Website bán hàng online LaraSu24')

@section('content')
<div class="container">
            <h2>Sản Phẩm Mới</h2>
            <div class="product-box">
                @foreach($spmoi as $sp)
                <div class="product">
                    @if (File::exists(public_path("img/$sp->img ")))
                        <img src="{{ asset("img/$sp->img") }}" alt="">
                    @else
                        <img src="{{ asset("img/$sp->img") }}" alt="">
                    @endif

                    <h3>{{ $sp->name }}</h3>
                    <p>{{ $sp->price }}</p>
                </div>
                @endforeach
            </div>
            <h2>Sản Phẩm Bán Chạy</h2>
            <div class="product-box">
                @foreach($banchay as $sp)
                <div class="product">
                    @if (File::exists(public_path('img/{{ $sp->img }}')))
                        <img src="{{ asset("img/$sp->img") }}" alt="">
                    @else
                        <img src="{{ asset("img/$sp->img") }}" alt="">
                    @endif
                    <h3>{{ $sp->name }}</h3>
                    <p>{{ $sp->price }}</p>
                </div>
                @endforeach
            </div>
            <h2>Sản Phẩm tồn kho - Giảm giá sốc</h2>
            <div class="product-box">
                @foreach($tonkho as $sp)
                <div class="product">
                    @if (File::exists(public_path('img/{{ $sp->img }}')))
                        <img src="{{ asset("img/$sp->img") }}" alt="">
                    @else
                        <img src="{{ asset("img/$sp->img") }}" alt="">
                    @endif
                    <h3>{{ $sp->name }}</h3>
                    <p>{{ $sp->price }}</p>
                </div>
                @endforeach
            </div>
        </div>

        @endsection
