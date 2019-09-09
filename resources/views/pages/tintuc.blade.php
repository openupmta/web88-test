@extends('layout.master-layout')
@section('content')
    <div class="content">
        <div class="container mt-1">
            <div class="row" style="margin-top: 80px;">
                <div class="col-md-8">
                    <div class="mt-1">
                        <!-- <div class="media p-12"> -->
                        @if($news)
                            @foreach($news as $key => $new)
                                @if($key == 0)
                                    <div class="row">
                                        <a href="{{ route('get.list.news',[$new->slug]) }}"><img class="col-md-4" src="{{ asset('assets/img_blogs/'.$new->image) }}"
                                             class="mr-3 mt-2" width="160" height="100"></a>
                                        <div class=" col-md-8">
                                            <i class="fa fa-calendar"> &nbsp </i>{{ $new->created_at }}
                                            <p><a href="{{ route('get.list.news',[$new->slug]) }}" class="big-title" href="javascript:void(0)">{{ $new->name }}</a></p>
                                            <p>{!! substr($new->summary,0,100).'...' !!} </p>
                                        </div>
                                    </div>
                                @else
                        <!-- </div> -->
                                    <hr>
                                <div class="media p-12">
                                    <a style="flex: none;" href="{{ route('get.list.news',[$new->slug]) }}"><img src="{{ asset('assets/img_blogs/'.$new->image) }}" class="mr-4 mt-2" width="160" height="100"></a>
                                    <div class="media-body">
                                        <p><a href="{{ route('get.list.news',[$new->slug]) }}">{{ $new->name }}</a></p>
                                        <i class="fa fa-calendar"> &nbsp </i>{{ $new->created_at }}
                                        <p>{!! substr($new->summary,0,100).'...' !!}</p>
                                </div>
                            </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <table border="1" style="border:1px solid black !important" class="text-left" cellpadding="9"
                           cellspacing="10">
                        <tr style="background: #06557c">
                            <td style="color: #fff;padding: 10px">
                                <h3 style="color: white;">
                                    <i class="fa-list-ul fa" style="margin-right: 10px"> </i> <span>Xem nhiều</span>
                                </h3>
                            </td>
                        </tr>
                        @if($newsHots)
                            @foreach($newsHots as $newsHot)
                        <tr>
                            <td class="td-tintuc"><a href="{{ Route('get.list.news',[$newsHot->slug]) }}">{{ $newsHot->name }}</a></td>
                        </tr>
                            @endforeach
                        @endif
                    </table>
                    <a href="javascript:void(0)" title=""><img class="img-1" style="width: 100%;"
                                                               src="http://thietkewebnhanh247.com/wp-content/themes/thietkewebsite/img/thiet-ke-website.jpg"
                                                               alt="Thiết kế web giá rẻ"></a>
                </div>
            </div> <br>
        </div>
    </div>
        <!--  -->

        <center>
            <ul class="pagination justify-content-center">
                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                <li class="page-item"><a class="page-link" href="page2.html">2</a></li>
                <li class="page-item"><a class="page-link" href="page3.html">3</a></li>
                <li class="page-item"><a class="page-link" href="page4.html">4</a></li>
                <li class="page-item"><a class="page-link" href="page5.html">5</a></li>
            </ul>
        </center>
@endsection
