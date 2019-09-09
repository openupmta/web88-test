<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- <LINK REL="SHORTCUT ICON"  HREF="/ thu_muc_dat_logo/tenlogo.ico"> -->
        <link rel="shortcut icon" href="image/icontab.ico" type="image/x-icon">
        <meta property="og:image" content="http://web88.vn/image/logo-okkk.png" />
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="627">
        <meta property="og:type" contex nt="website" />
        <meta property="og:url" content="http://web88.vn/" />
        <meta property="og:title" content="Thiết Kế Website Chuyên Nghiệp" />
        <meta property="og:description" content="Thiết kế web chuyên nghiệp của Talent Wins sử dụng công nghệ thiết kế web chuyên nghiệp, thiết kế web nhanh chỉ với bốn bước cơ bản. Website được tối ưu với các công cụ tìm kiếm, Website tương thích với các thiết bị di động…" />
        
    <!-- boostrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- reset css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&display=swap&subset=vietnamese" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,700&display=swap" rel="stylesheet">
    <!-- Slider top -->
    
    <!-- Slick css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
    <!-- WOW JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- style.css -->
    <link rel="stylesheet" href="{{ asset('css/dichvu-thietkewebgiare.css') }}">
    <link rel="stylesheet" href="{{ asset('css/banggiathietkewebsite.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/domaingiare.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hostingchatluongcao.css') }}">
    <link rel="stylesheet" href="{{ asset('css/khachhang.css') }}">
    <link rel="stylesheet" href="{{ asset('css/khogiaodien.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lienhe.css') }}">
    <link rel="stylesheet" href="{{ asset('css/masterpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicebox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/query.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
    
<body>
    @include('layout.header')
    @yield('content')
    @include('layout.footer')

<!-- bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Font-awesome -->
<script src="{{ asset('js/df8fdd30a5.js') }}"></script>
<!-- jQuery -->
<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
<!-- Slider top -->
<script src="{{ asset('js/modernizr.custom.46884.js') }}"></script>
<script src="{{ asset('js/jquery.slicebox.js') }}"></script>
<script src="{{ asset('js/textyle.js') }}"></script>
<!-- Textyle -->
<script src="{{asset('js/main.js')}}"></script>
<!-- Slick JS -->
<script type="text/javascript" src="{{asset('js/slick.min.js')}}"></script>
<!-- WOW JS -->
<script src="{{asset('js/wow.min.js')}}"></script>

<script>
    new WOW().init();
</script>
<!-- Slider.js -->
    <script src="{{ asset('js/slider.js') }}"></script>
    <script>
        window.onscroll = function() { scrollFunction(), scrollMenuHide() };

        function scrollFunction() {
            if (window.pageYOffset > 450) {
                document.getElementById("back-to-top").style.display = "block";
            } else {
                document.getElementById("back-to-top").style.display = "none";
            }
        };
        if($('#back-to-top').length) {
            var scrollTrigger = 100,
                backToTop = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > scrollTrigger) {
                        $('#back-to-top').addClass('show');
                    } else {
                        $('#back-to-top').removeClass('show');
                    }
                };
            backToTop();
            $(window).on('scroll', function () {
                backToTop();
            });
            $('#back-to-top').on('click', function (e) {
                e.preventDefault();
                $('html,body').animate({
                    scrollTop: 0
                }, 700);
            });
        }

    </script>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v4.0'
    });
  };

  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="100910621259961"
  logged_in_greeting="Xin chào! Web88 có thể giúp gì cho bạn?"
  logged_out_greeting="Xin chào! Web88 có thể giúp gì cho bạn?">
</div>
</html>
