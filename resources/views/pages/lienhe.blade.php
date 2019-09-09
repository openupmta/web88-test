@extends('layout.master-layout')
@section('content')
<div class="content">
    {{--<div class="content__top">--}}
        {{--<div class="content__top-img">--}}
            {{--<div class="col-12 col-md-12 content-block">--}}

                {{--<h3 class="content__top-title wow bounceInLeft">--}}
                    {{--Hơn 1000 giao diện web cực đẹp và liên tục được cập nhật--}}
                {{--</h3>--}}
                {{--<p class="content__top-desc wow bounceInRight">--}}
                    {{--Thay đổi dễ dàng theo phong cách của riêng của bạn--}}
                {{--</p>--}}
                {{--<form action=""  style="width: 100%;padding-left:40%">--}}
                    {{--<div class="input-group col-sm-4 form__search">--}}
                        {{--<input  class="form-control"--}}
                                {{--placeholder="Tìm kiếm" name="name" value="{{ \Request::get('name') }}">--}}
                        {{--<button class="input-group-addon btn btn-primary btn-search" >--}}
                            {{--<i class="fas fa-search"></i>--}}
                        {{--</button>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
    <!--  -->
    <div class="content-main" style="padding: 30px 0 !important;">
        <div class="container">
            <div id="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3722.8580470816796!2d105.7853450142462!3d21.07833109146162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aacbe6b051d3%3A0x99154d3da13e19eb!2zNDMgUGjhuqFtIFbEg24gxJDhu5NuZywgWHXDom4gxJDhu4luaCwgVOG7qyBMacOqbSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1564358693310!5m2!1svi!2s" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="contact__company" style="padding-top: 50px!important;">
                <div class="col-md-5 col-12">
                    <h3 class="contact__company-title">Liên hệ</h3>
                    <p class="contact__company-desc">Thiết kế web nhanh</p>
                    <p class="contact__company-name">{{ $contact->title }}</p>

                    <div class="contact__box">
                        <p class="contact__box-location">
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            <span>{{ $contact->address }}</span>
                        </p>
                        <p>
                            <i class="fas fa-phone-alt fa-fw"></i>
                            <span>{{ $contact->phone }}</span>
                        </p>
                        <p>
                            <i class="fas fa-envelope fa-fw"></i>
                            <a href="javascript:void(0)"><span>{{ $contact->email }}</span></a>
                        </p>
                    </div>
                </div>
                <div class="col-md-7 col-12">
                    <form action="{{ Route('khoi.tao.web') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1" style="padding-top: 2rem;">Tên của bạn ✵</label><br>
                            <input type="text" class="form-control" name="w_name" id="dk_name" placeholder="Tên của bạn">
                            <input type="hidden" name="w_id" id="dk_id">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ ✵</label><br>
                            <input type="text" name="w_address" class="form-control" id="dk_address" aria-describedby="emailHelp" placeholder="Địa chỉ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ Email ✵</label><br>
                            <input type="email" name="w_email" class="form-control" id="dk_email" aria-describedby="emailHelp" placeholder="Nhập địa chỉ email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số điện thoại ✵</label><br>
                            <input type="number" name="w_phone" class="form-control" id="dk_sdt" placeholder="Nhập số điện thoại">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu đề</label><br>
                            <input type="text" name="w_title" class="form-control" id="dk_title" aria-describedby="emailHelp" placeholder="Tiêu đề">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Nội dung</label><br>
                            <textarea class="form-control" name="w_content" id="dk_content" rows="3" placeholder="Thông điệp"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success" style="margin-left: 20px!important;">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection