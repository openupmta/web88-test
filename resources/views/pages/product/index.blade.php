@extends('layout.master-layout')
@section('content')
<div class="content">
    <div class="content__top">
        <div class="content__top-img" style=" background-image:url('{{ asset('image/banner-top.jpg') }}')">
            <div class="col-12 col-md-12 content-block">
                <h3 class="content__top-title wow bounceInLeft">
                    Hơn 1000 giao diện web cực đẹp và liên tục được cập nhật
                </h3>
                <p class="content__top-desc wow bounceInRight">
                    Thay đổi dễ dàng theo phong cách của riêng của bạn
                </p>
                <form action=""  style="width: 100%;padding-left:40%">
                    <div class="input-group col-sm-4 form__search">
                        <input  class="form-control"
                                placeholder="Tìm kiếm" name="name" value="{{ \Request::get('name') }}">
                        <button class="input-group-addon btn btn-primary btn-search" >
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!--  -->
    <div class="list__category">
        <div class="container">
            <div class="row wow bounceInUp">
                @if(isset($cateweb))
                    @foreach($cateweb as $cate)
                        <div class="col-md-3 col-sm-6" style="margin-bottom:15px;">
                            <center>
                                <a href="{{ route('get.list.product',[$cate->slug,$cate->id]) }}"></a>
                                <a href="{{ route('get.list.product',[$cate->slug,$cate->id]) }}"><img src="{{ asset('assets/img_icon/'.$cate->icon) }}" alt=""></a>
                                <p><a href="">{{ $cate->name }}</a></p>
                            </center>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- main -->
    <div class="woocommerce">
        <div class="container">
            <div class="row">
                @if(isset($products))
                    @foreach($products as $product)
                        <div class="col-12 col-sm-6 box col-md-4 woocommerce__list wow bounceInLeft woocommerce__list-img" style="background-image:url({{ asset('assets/img_webs/'.$product->image )}})">
                            <div style="padding-top: 400px;">
                                <center>
                                    <p>{{ $product->name }}</p>
                                </center>
                                <p class="woocommerce__list-text">
                                    <a href="{{ $product->link }}" class="btn btn-warning">
                                        <i class="far fa-eye"></i>
                                        Dùng thử</a>
                                    <a class="btn btn-success" onclick="document.getElementById('id01').style.display='block'">
                                        <i class="fas fa-check"></i>
                                        Chọn mẫu web này</a>
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- phân trang -->
    <center>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                {{ $products->links() }}
            </ul>
        </nav>
    </center>
@endsection