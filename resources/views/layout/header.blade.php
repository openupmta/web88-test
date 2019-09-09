<header>
    <div class="header">
        <!-- Thanh điều hướng -->

        <nav class="navbar navbar-expand-lg navbar-dark nav-top" id="navbar">
            <div class="container">
                <!-- Brand/logo -->
                <a class="navbar-brand" href="index.html">
                    <img src="{{ asset('image/logo.jpg') }}" alt="logo" class="logo">
                </a>

                <!-- Links -->
                <ul class="navbar-nav ul-nav">
                    <li class="nav-item">
                        <a href="{{ Route('home') }}" class="nav-link text-dark href="">TRANG CHỦ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-light" href="{{ Route('kho.giao.dien') }}">KHO GIAO DIỆN <i class="fa fa-plus plus" aria-hidden="true"></i></a>
                        <div class="dropdown-content">
                            @if(isset($cateweb))
                                @foreach($cateweb as $cate)
                                    <a href="{{ route('get.list.product',[$cate->slug,$cate->id]) }}">{{ $cate->name }}</a>
                                @endforeach
                            @endif
                        </div>
                    </li>
                    <li class="nav-item  dropdown">
                        <a class="nav-link text-light" >DỊCH VỤ <i class="fa fa-plus plus" aria-hidden="true"></i></a>
                        <div class="dropdown-content">

                            @if(isset($servis))
                                @foreach($servis as $servi)
                                    <a href="{{ Route('get.list.service',[$servi->slug]) }}">{{ $servi->name }}</a>
                                @endforeach
                            @endif

                            {{--<a href="{{ Route('thiet.ke.website.theo.mau') }}">Thiết kế web theo mẫu</a>--}}
                            {{--<a href="{{ Route('thiet.ke.web.theo.yeu.cau') }}">Thiết kế web theo yêu cầu</a>--}}
                            {{--<a href="{{ Route('thiet.ke.web.chuan.seo.chuyen.nghiep') }}">Thiết kế web chuẩn SEO chuyên nghiệp</a>--}}
                            {{--<a href="{{ Route('thiet.ke.web.chuan.mobile') }}">Thiết kế web chuẩn Mobile</a>--}}
                            {{--<a href="{{ Route('dich.vu.seo.website') }}">Dịch vụ SEO website</a>--}}
                            {{--<a href="{{ Route('dich.vu.seo.website') }}">Dịch vụ viết bài SEO website</a>--}}
                            {{--<a href="{{ Route('thiet.web.tron.goi.gia.re') }}">Thiết kế web trọn gói giá rẻ</a>--}}
                            {{--<a href="{{ Route('cham.soc.website') }}">Chăm sóc website</a>--}}
                            {{--<a href="{{ Route('hosting.chat.luong.cao') }}">Hosting chất lượng cao</a>--}}
                            {{--<a href="{{ Route('domain.gia.re') }}">Domain giá rẻ</a>--}}
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ Route('thiet.ke.website') }}">THIẾT KẾ WEBSITE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ Route('seo') }}">SEO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ Route('khach.hang') }}">KHÁCH HÀNG</a>
                    </li>
                    <li class="nav-item  dropdown">
                        <a class="nav-link text-light">THÊM <i class="fa fa-plus plus" aria-hidden="true"></i></a>
                        <div class="dropdown-content">
                            <a href="{{ Route('tin.tuc') }}">Tin tức</a>
                            @if(isset($otherservi))
                                @foreach($otherservi as $other)
                                    <a href="{{ Route('get.list.other.service',[$other->slug]) }}">{{ $other->name }}</a>
                                @endforeach
                            @endif
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ Route('lien.he') }}">LIÊN HỆ</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-light" onclick="document.getElementById('id01').style.display='block'">ĐĂNG KÝ</a>
                    </li>
                </ul>
                <span class="ba-vach" onclick="openNav()">&#9776;</span>
            </div>
        </nav>
        <!-- end navbar -->
    </div>
    <div id="mySidenav" class="sidenav">
        <div>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" title="Đóng Menu">&times;</a>
        </div>

        <a href="index.html">TRANG CHỦ</a>
        <a class="nav-link col1">KHO GIAO DIỆN<i class="fa fa-plus plus" style=" margin-left: 0.5rem;" aria-hidden="true"></i></a>
        <div class="kho-giao-dien" id="col1" style="display: none;">
            @if(isset($cateweb))
                @foreach($cateweb as $cate)
                    <a href="{{ route('get.list.product',[$cate->slug,$cate->id]) }}">{{ $cate->name }}</a>
                @endforeach
            @endif
        </div>
        <a class="nav-link col2">DỊCH VỤ<i class="fa fa-plus plus" aria-hidden="true" style="
    margin-left: 0.5rem;"></i></a>
        <div class="kho-giao-dien" id="col2" style="display: none;">
            @if(isset($servis))
                @foreach($servis as $servi)
                    <a href="{{ Route('get.list.service',[$servi->slug]) }}">{{ $servi->name }}</a>
                @endforeach
            @endif
        </div>
        <a href="{{ Route('thiet.ke.website') }}">THIẾT KẾ WEBSITE</a>
        <a href="{{ Route('seo') }}">SEO</a>
        <a href="{{ Route('khach.hang') }}">KHÁCH HÀNG</a>
        <a href="#" class="nav-link col3">THÊM<i class="fa fa-plus plus" aria-hidden="true" style="
    margin-left: 0.5rem;"></i></a>
        <div class="kho-giao-dien" id="col3" style="display: none;">
            <a href="{{ Route('tin.tuc') }}">Tin tức</a>
            @if(isset($otherservi))
                @foreach($otherservi as $other)
                    <a href="{{ Route('get.list.other.service',[$other->slug]) }}">{{ $other->name }}</a>
                @endforeach
            @endif
        </div>
        <a href="{{ Route('lien.he') }}">LIÊN HỆ</a>
        <a onclick="document.getElementById('id01').style.display='block'">ĐĂNG KÝ</a>
    </div>

    @yield('slider')


</header>