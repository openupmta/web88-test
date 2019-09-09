@extends('layout.master-layout')
@section('content')
    <div class="content">
        <div class="content__top">
            <div class="content__top-img" style=" background-image:url({{ asset('assets/img_other_service/'.$otherService->image) }})">
                <div class="col-12 col-md-12 content-block">
                    <h3 class="content__top-title wow bounceInLeft">
                        {!! $otherService->title !!}
                    </h3>
                    <p class="content__top-desc wow bounceInRight">
                        <!-- Dịch vụ web hosting uy tín, ổn định -->
                    </p>
                    <div class="input-group form__search">
                        <p class="ghichu">{{ $otherService->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
        <div class="content-main">
            <div class="container">
                <div class="time">
                    <span><i class="far fa-calendar-alt"></i>{{ $otherService->created_at }}</span>
                    <div class="fb-like" data-href="http://localhost:81/Haizzzzzzz/hostingchatluongcao.html" data-width=""
                         data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                </div>
                <div class="index">
                    {!! $otherService->summary !!}
                </div>
                {!! $otherService->content !!}
            </div>

        </div>
        <div class="slide-content-bottom">
            <div class="container">
                <p class="slide-bottom-title">DỊCH VỤ LIÊN QUAN</p>
                <div class="service__silder">
                    @if(isset($sliders))
                        @foreach($sliders as $slider)
                            <img src="{{ asset('image/slider-content/'.$slider->image )}}" alt="">
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
@endsection
