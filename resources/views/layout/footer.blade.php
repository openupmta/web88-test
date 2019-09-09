<div class="contact">
    <div class="container">
        <div class="contact__wrap">
            <h4 class="contact__wrap-text">
                Chúng tôi hỗ trợ khách hàng 7 ngày trong tuần với hotline
                <br>
                <span>{{ $contact->phone }}</span>
            </h4>
            <p class="contact__wrap-desc">Với đội ngũ nhân viên hơn 5 năm kinh nghiệm, không chỉ là hướng dẫn và xử lý các vấn đề từ website, chúng tôi luôn đồng hành tư vấn và phát triển cùng doanh nghiệp của bạn</p>
            <ul class="row">
                @if(isset($supports))
                    @foreach($supports as $support)
                <li class="col-md-3 col-sm-6" style="margin-top:30px;">
                    <center>
                        <div>
                            <img src="{{ asset('assets/img_supports/'.$support->image) }}" class="img-circle" width="140px;margin-left:30px!important;">
                        </div>
                        <div class="contact__wrap-detail">
                            <p class="contact__wrap-detail--text">
                                <span>{{ $support->name }}</span>
                                <br>
                                <a href="javascript:void(0)">{{ $support->phone }}</a>
                                <br>
                                <a href="javascript:void(0)">{{ $support->email }}</a>
                            </p>
                        </div>
                    </center>
                </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
</div>
<footer class="footer">
    <div class="footer__wrap">
        <div class="container">
            <div class="row">
                <div class=" col-md-3 col-sm-6 col-12">
                    <ul class="footer__wrap-info">
                        @if(isset($contact))
                        <li>
                            <i class="fas fa-user fa-fw check"></i>
                            <a href="javascript:void(0)" class="footer__wrap-info--text">{{ $contact->title }}</a>
                        </li>
                        <li>
                            <i class="fab fa-codepen fa-fw check"></i>
                            <a href="javascript:void(0)" class="footer__wrap-info--text">Mã số thuế: {{ $contact->masothue }}</a>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw check "></i>
                            <a href="javascript:void(0)" class="footer__wrap-info--text special">{{ $contact->address }}</a>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt fa-fw check"></i>
                            <a href="javascript:void(0)" class="footer__wrap-info--text">{{ $contact->phone }}</a>
                        </li>
                        <li>
                            <i class="far fa-envelope fa-fw
                                check"></i>
                            <a href="javascript:void(0)" class="footer__wrap-info--text">{{ $contact->email }}</a>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="footer__detail">
                        <p class="footer__detail-service--title">
                            Dịch vụ
                        </p>
                        <ul class="footer__detail-service--text">

                            @if(isset($serviHot))
                                @foreach($serviHot as $value)
                                    <li>
                                        <i class="fas fa-angle-double-right"></i>
                                        <a href="{{ Route('get.list.service',[$value->slug]) }}">{{ $value->name }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="footer__detail">
                        <p class="footer__detail-support--title">
                            Hỗ trợ
                        </p>
                        <ul class="footer__detail-support--text">
                            @if(isset($otherHot))
                                @foreach($otherHot as $hot)
                                    <li>
                                        <i class="fas fa-angle-double-right"></i>
                                        <a href="javascript:void(0)">{{ $hot->name }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="footer__detail">
                        <p class="footer__detail-design--title">
                            Thiết kế website
                        </p>
                        <ul class="footer__detail-design--text">
                            @if(isset($newHot))
                                @foreach($newHot as $value)
                                    <li>
                                        <i class="fas fa-angle-double-right"></i>
                                        <a href="javascript:void(0)">{{$value->name }}</a>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copy__right">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-12 copy__right--text">
                <p>
                    <i class="far fa-copyright"></i>
                    <a href="javascript:void(0)">Copyright 2019 | Designed by Talent Wins | Dịch vụ thiết kế website hàng đầu Việt Nam</a>
                </p>
            </div>
            <div class="col-md-3 col-12 copy__right--icon">
                <i class="fab fa-facebook-square fa-2x"></i>
                <i class="fab fa-google-plus-square fa-2x"></i>
                <i class="fab fa-twitter-square fa-2x"></i>
                <i class="fas fa-rss-square fa-2x"></i>
                <i class="fab fa-linkedin fa-2x"></i>
            </div>
        </div>
    </div>
</div>

<!-- form dang ki -->
<div id="id01" class="modal">

    <form id="dk_form" class="modal-content animate" action="{{ Route('khoi.tao.web')}}" method="POST">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach

            </div>

        @endif
        @if(session('thongbao'))
            <div class="alert alert-success">
                {{session('thongbao')}}
            </div>
        @endif
        @csrf
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        <div class="container pt-4" style="padding-bottom: 2rem;">
            <div class="row">
                <div class="info-contact col-md-4">
                    <h5 style="padding: 2rem 0; color: #333">Thông tin liên hệ</h5>
                    <div class="mt-50 text-left">
                        <div class="col-md-12 d-flex justify-content-start content-contact" style="padding-bottom: 1.5rem">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $contact->address }}</span>
                        </div>
                        <div class="col-md-12 d-flex justify-content-start content-contact" style="padding-bottom: 1.5rem">
                            <i class="fas fa-envelope"></i>
                            <span>{{ $contact->email }}</span>
                        </div>
                        <div class="col-md-12 d-flex justify-content-start content-contact" style="padding-bottom: 1.5rem">
                            <i class="fas fa-phone-alt"></i>
                            <span>{{ $contact->phone }} - Zalo</span>
                        </div>
                        <div class="col-md-12 d-flex justify-content-start content-contact" style="padding-bottom: 1.5rem">
                            <i class="fas fa-globe"></i>
                            <span><a href="javascript:void(0)">{{ $contact->website }}</a></span>
                        </div>
                    </div>
                    <div class="text-center"><img src="{{ asset('image/contact.jpg')}}" alt=""></div>
                </div>
                <div class="col-md-8">

                    <form id="dk_form" method="POST" >
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
    </form>
</div>
<!-- form dang ki end -->

<!-- Back to top -->

<a href="#" id="back-to-top" title="Back to top"><img src="http://thietkewebnhanh247.com/wp-content/themes/thietkewebsite/img/top.png" style="width:35px; height:auto" alt=""></a>
<!-- Phone -->
<a href="tel:0927151535" mypage="" class="call-now" rel="nofollow">
    <div class="mypage-alo-phone">
        <div class="animated infinite zoomIn mypage-alo-ph-circle">
        </div>
        <div class="animated infinite pulse mypage-alo-ph-circle-fill">
        </div>
        <div class="animated infinite tada mypage-alo-ph-img-circle">
        </div>
    </div>
</a>
</body>