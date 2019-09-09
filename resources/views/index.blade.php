@extends('layout.master-layout')
@section('title','Thiết kế website chuyên nghiệp')
@section('slider')
    <div class="wrap-header">
    <div class="slider-top">
        <ul id="sb-slider" class="sb-slider">
            @if(isset($sliders))
                @foreach($sliders as $key => $slider)
            <li>
                <a href="javascript:void(0)">
                    <img width="1349" height="625" src="{{ asset('assets/slider-index/'.$slider->image )}}" alt="">
                </a>
                <div class="slide-text">
                    {{--<h3 class="slide-text--title">Talent Wins</h3>--}}
                    <p class="slide-text--desc">{{ $slider->title }}</p>
                    {{--<p class="slide-text--desc2">cho doanh nghiệp</p>--}}
                </div>
                <!-- <div class="sb-description">
                  <h3>Creative Lifesaver</h3>
                </div> -->
                @if($key == 0)
                    <img class="icon-animation icon-animation-1 animated bounceInLeft delay-0s" src="{{asset('assets/slider-index/banner_4_-21.png')}}" alt="">
                    <img class="icon-animation icon-animation-2 animated bounceInRight delay-0s" src="{{asset('assets/slider-index/banner_4_-31.png')}}" alt="">
                @elseif($key == 1)
                    <img class="icon-animation icon-animation-3 animated flipInX delay-1s" src="{{asset('assets/slider-index/banner_4_-91.png')}}" alt="">
                    <img class="icon-animation icon-animation-4 animated flipInX delay-1s" data-wow-delay="1s" src="{{asset('assets/slider-index/banner_4_-11.png')}}" alt="">
                    <img class="icon-animation icon-animation-5 animated flipInX delay-1s" src="{{asset('assets/slider-index/icon-1.png')}}" alt="">
                    <h1 class="talent animated zoomIn">Hello World!</h1>
                @endif
            </li>
                @endforeach
            @endif
        </ul>

        <!-- <div id="shadow" class="shadow"></div>
-->
        <div id="nav-arrows" class="nav-arrows">
            <a href="#">Next</a>
            <a href="#">Previous</a>
        </div>

        </div>
    </div>
</header>
@endsection
@section('content')
<div class="content">
    <div class="services__index">
        <div class="container">
            <div class="group__services">
                <div class="row">
                    <div class="col-12 group__services-wrap">
                        <h2 class="group__services-text wow flash">Nhu cầu thiết kế website của bạn</h2>
                        <ul class="list__services">
                            <li class="col-12 col-md-4 list__services-stt list__services-stt-1 wow fadeInLeft" onmouseover="hoverOver()" onmouseout="hoverOut()">
                                <img class="list__services-img" src="http://thietkewebnhanh247.com/wp-content/themes/thietkewebsite/img/giaiphap1.png" alt="">
                                <a href="javascript:void(0)" class="list__services-link">
                                    Thiết kế website
                                </a>
                                <h3 class="list__services-title">
                                    <a href="javascript:void(0)">Doanh nghiệp</a>
                                </h3>
                                <p class="list__services-desc">
                                    <a href="javascript:void(0)">Phát triển và thúc đẩy doanh nghiệp, gia tăng giá trị thương hiệu</a>
                                </p>
                            </li>
                            <li class="col-12 col-md-4 list__services-stt list__services-stt-2 wow bounceInDown" data-wow-delay="1s">
                                <img class="list__services-img" src="http://thietkewebnhanh247.com/wp-content/themes/thietkewebsite/img/giaiphap2.png" alt="">
                                <a href="javascript:void(0)" class="list__services-link">
                                    Thiết kế website
                                </a>
                                <h3 class="list__services-title">
                                    <a href="javascript:void(0)">THEO YÊU CẦU RIÊNG</a>
                                </h3>
                                <p class="list__services-desc">
                                    <a href="javascript:void(0)">Đưa ra ý tưởng và tập trung vào kinh doanh, chuyện còn lại để chúng tôi lo</a>
                                </p>
                                {{--<p class="view-more">--}}
                                    {{--<a href="javascript:void(0)">Xem thêm</a>--}}
                                {{--</p>--}}
                            </li>
                            <li class="col-12 col-md-4 list__services-stt list__services-stt-1 wow fadeInRight" onmouseover="hoverOver()" onmouseout="hoverOut()">
                                <img class="list__services-img" src="http://thietkewebnhanh247.com/wp-content/themes/thietkewebsite/img/giaiphap3.png" alt="">
                                <a href="javascript:void(0)" class="list__services-link">
                                    Thiết kế website
                                </a>
                                <h3 class="list__services-title">
                                    <a href="javascript:void(0)">SHOP BÁN HÀNG</a>
                                </h3>
                                <p class="list__services-desc">
                                    <a href="javascript:void(0)">Tăng doanh số và thúc đẩy kinh doanh, chiếm lĩnh thị trường trực tuyến</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="hr">

            </div>
        </div>
    </div>
    <div class="services__block">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3 services__block-stt wow bounceInLeft">
                    <a href="javascript:void(0)">
                        <i class="fas fa-book fa-3x"></i>

                    </a>
                    <p class="services__block-text">
                        <a href="javascript:void(0)">Khách hàng lựa chọn giao diện website phù hợp</a>
                    </p>
                </div>
                <div class="col-12 col-sm-6 col-md-3 services__block-stt wow bounceInDown">
                    <a href="javascript:void(0)">
                        <i class="far fa-list-alt fa-3x"></i>

                    </a>
                    <p class="services__block-text">
                        <a href="javascript:void(0)">Cung cấp thông tin và yêu cầu chỉnh sửa website</a>
                    </p>
                </div>
                <div class="col-12 col-sm-6 col-md-3 services__block-stt wow bounceInDown">
                    <a href="javascript:void(0)">
                        <i class="fas fa-pencil-alt fa-3x"></i>

                    </a>
                    <p class="services__block-text">
                        <a href="javascript:void(0)">Chỉnh sửa theo yêu cầu và tiến hành demo</a>
                    </p>
                </div>
                <div class="col-12 col-sm-6 col-md-3 services__block-stt wow bounceInRight">
                    <a href="javascript:void(0)">
                        <i class="fas fa-globe-americas fa-3x"></i>
                    </a>
                    <p class="services__block-text">
                        <a href="javascript:void(0)">Tiến hành chạy thử nghiệm và bàn giao sản phẩm</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="welcome__massage">
        <div class="container">
            <div class="welcome__massage-wrap">
                <h3 class="wow bounceInUp">
                    Vì <span>1000+ doanh nghiệp</span> Việt Nam thành công hơn với internet
                </h3>
                <p class="wow bounceInUp welcome__massage-wrap--text">Thiết kế web chuyên nghiệp của Talent Wins sử dụng công nghệ thiết kế web chuyên nghiệp, thiết kế web nhanh chỉ với bốn bước cơ bản. Website được tối ưu với các công cụ tìm kiếm, Website tương thích với các thiết bị di động… Giao diện sang trọng, tiện dụng… Dễ dàng thay đổi theo phong cách riêng của bạn…</p>
                <p class="wow bounceInUp">
                    <a class="btn btn-warning" onclick="document.getElementById('id01').style.display='block'">
                        <i class="far fa-hand-point-right"></i>
                        Xem thêm
                    </a>
                    <a href="{{ route('kho.giao.dien') }}" class="btn btn-success">
                        <i class="far fa-heart"></i>
                        Trải nghiệm ngay
                    </a>
                </p>
            </div>
        </div>
    </div>
    <div class="list__category">
        <div class="container">

            <div class="row wow bounceInUp">
                @if(isset($catewebs))
                    @foreach($catewebs as $cate)
                        <div class="col-md-3 col-sm-6" style="margin-bottom:15px;">
                            <center>
                                <a href="{{ route('get.list.product',[$cate->slug,$cate->id]) }}"></a>
                                <a href="{{ route('get.list.product',[$cate->slug,$cate->id]) }}"><img src="{{ asset('assets/img_icon/'.$cate->icon ) }}" alt=""></a>
                                <p><a href="">{{ $cate->name }}</a></p>
                            </center>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </div>
    <div class="woocommerce">
        <div class="container">
            <div class="row">
                @if(isset($webs))
                    @foreach($webs as $web)
                <div class="col-12 col-sm-6 box col-md-4 woocommerce__list wow bounceInLeft woocommerce__list-img" style="background-image:url({{ asset('assets/img_webs/'.$web->image )}})">
                    <div style="padding-top: 400px;">
                    <center>
                        <p>{{ $web->name }}</p>
                    </center>
                    <p class="woocommerce__list-text">
                        <a href="{{ $web->link }}" class="btn btn-warning">
                            <i class="far fa-eye"></i>
                        Dùng thử</a>
                        <a class="btn btn-success" onclick="hien({{ $web->id }})">
                            <i class="fas fa-check"></i>
                        Chọn mẫu web này</a>
                    </p>
                    </div>
                </div>
                    @endforeach
                @endif
            </div>
            <script>
                function hien(id) {
                    //alert(id);
                    $('#dk_id').val(id);
                    document.getElementById('id01').style.display='block'
                }
            </script>
        </div>
    </div>
                <!-- phân trang -->
                <center>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            {{ $webs->links() }}
                        </ul>
                    </nav>
                </center>
    <div class="more__info">

        <div class="more__info-wrap">
            <div class="container">
                <div class="col-12 col-md-12 more__info-wrap--p">
                    <h2 class="more__info-wrap--title wow bounceInLeft">
                        DỊCH VỤ THIẾT KẾ WEB CHUYÊN NGHIỆP - THIẾT KẾ WEB NHANH CAM KẾT:
                    </h2>
                    <p class="more__info-wrap--desc wow bounceInRight">
                        Không dừng lại ở thiết kế website chuyên nghiệp, chúng tôi mang lại những công cụ để khách hàng có thể bán hàng trực tuyến và phát triển thương hiệu một cách hiệu quả nhất. Với chúng tôi, thành công của khách hàng cũng chính là thành công của chúng tôi
                    </p>
                    <div class="more__info-wrap--btn">
                        <a href="{{ Route('kho.giao.dien') }}" class="btn btn-warning wow bounceInLeft">
                            <i class="far fa-image"></i>
                        Kho giao diện</a>
                        <a href="javascript:void(0)" class="btn btn-success wow bounceInRight">
                            <strong>$</strong> Bảng giá dịch vụ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="customer wow shake">
        <div class="customer__text">
            <h2 class="group__services-text">
                Khách hàng làm web
            </h2>
            <p class="customer__text--desc">KHÁCH HÀNG VÀ ĐỐI TÁC SỬ DỤNG DỊCH VỤ THIẾT KẾ WEB</p>
        </div>
        <div class="customer__silder">
            @if(isset($partners))
                @foreach($partners as $partner)
                    <a title="{{ $partner->name }}" href="{{ $partner->link }}"><img src="{{ asset('assets/img_partner/'.$partner->logo) }}" alt=""></a>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
