@extends('layout.master-layout')
@section('title','Khách hàng')
@section('content')
<div class="content">
    <div class="content__top">
        <div class="content__top-img" style=" background-image:url({{ asset('assets/img_partner/header_saigonbg.jpg') }})">
            <div class="col-12 col-md-12 content-block">
                <h3 class="content__top-title wow bounceInLeft">
                    KHÁCH HÀNG CỦA THIẾT KẾ WEBSITE NHANH
                </h3>
                <p class="content__top-desc wow bounceInRight">
                    <!-- Dịch vụ web hosting uy tín, ổn định -->
                </p>
                <div class="input-group form__search">
                    <p class="ghichu">Hơn 1000 khách hàng tin tưởng sử dụng dịch vụ của chúng tôi, từ các cửa hàng nhỏ lẻ cho tới các doanh nghiệp lớn</p>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <div class="content-main">
        <div class="container">
            <div class="row">
                <div class="customer__block-img">
                    @if(isset($partners))
                        @foreach($partners as $partner)
                            <div class="col-md-3 col-sm-4 col-12">
                                <a href="{{ $partner->link }}"><img width="316" height="200" class="customer__img" src="{{ asset('assets/img_partner/'.$partner->logo) }}" title="{{ $partner->name }}"></a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection