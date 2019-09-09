@extends('admins.layout.master-layout')
@section('title')
    Slider
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Slider
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Slider</li>
            </ol>
        </section>
        <br>
        <div>
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
        </div>


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            {{-- Mục lục --}}
                            <h3 class="box-title">Danh mục</h3>

                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">

                                <li><a href="{{route('slider.create')}}"><i class="fa fa-envelope-o"></i> Thêm Slider
                                    </a></li>
                                </a>
                                </li>
                                <li><a href="{{route('slider.index')}}"><i class="fa fa-file-text-o"></i> Danh
                                        sách<span class="label label-primary pull-right">{{$slider_count}}</span></a></li>

                            </ul>
                        </div>

                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
                    {{-- End mục luc --}}

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="box box-primary">
                        <h3 style="text-align: left; padding-left: 5px">Sửa Slider</h3>
                        <form role="form" method="POST" action="{{route('slider.update',['id'=>$slider->id])}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                {{--<div class="form-group">--}}
                                {{--<label>Thể loại</label>--}}
                                {{--<select class="form-control" name="cate_slider">--}}
                                {{--@foreach($cate_slider as $cate)--}}
                                {{--<option value="{{$cate->id}}">{{$cate->name}}</option>--}}
                                {{--@endforeach--}}
                                {{--</select>--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Slider (*)</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên Slider" name="name"
                                           value="{{ $slider->title }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Ảnh nền</label>
                                    <input type="file" id="image" name="image" onchange="showIMG()">
                                </div>

                                <div class="form-group">
                                    <label for="" style="margin-left: 10px"> Ảnh hiển thị : </label>
                                    <div id="viewImg">
                                        <img width="100px" height="150px" src="{{asset('')}}assets/slider-index/{{$slider ->image}}">
                                    </div>
                                </div>


                                {{--Tiêu điểm --}}
                                <div class="form-group">
                                    <label>Hiển thị</label>
                                    <label class="radio-inline">
                                        <input name="active" value="1" checked="" type="radio">Có
                                    </label>
                                    <label class="radio-inline">
                                        <input name="active" value="0" type="radio">Không
                                    </label>
                                </div>
                                {{--Hết tiêu điểm--}}

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Sửa</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>


@endsection
<script>


    function showIMG() {
        var fileInput = document.getElementById('image');
        var filePath = fileInput.value; //lấy giá trị input theo id
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; //các tập tin cho phép
        //Kiểm tra định dạng
        if (!allowedExtensions.exec(filePath)) {
            alert('Bạn chỉ có thể dùng ảnh dưới định dạng .jpeg/.jpg/.png/.gif extension.');
            fileInput.value = '';
            return false;
        } else {
            //Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('viewImg').innerHTML = '<img style="width:100px; height: 100px;" src="' + e.target.result + '"/>';
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }

</script>

