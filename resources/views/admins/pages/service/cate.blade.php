@extends('admins.layout.master-layout')
@section('title')
    Dịch vụ
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dịch vụ
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dịch vụ</li>
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
                                <li><a href="{{route('service.createCate')}}"><i class="fa fa-inbox"></i> Thêm thể loại
                                        dịch vụ
                                        <span class="label label-primary pull-right">{{$cate_service_count}}</span></a></li>
                                <li><a href="{{route('service.create')}}"><i class="fa fa-envelope-o"></i> Thêm dịch vụ
                                        <span class="label label-primary pull-right">{{$service_count}}</span></a></li>
                                </a>
                                </li>
                                <li><a href="{{route('service.index')}}"><i class="fa fa-file-text-o"></i> Danh
                                        sách</a></li>

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
                        <h3 style="text-align: left; padding-left: 5px">Thêm thể loại</h3>
                        <form role="form" method="POST" action="{{route('service.storeCate')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thể loại(*)</label>
                                    <input type="text" class="form-control" placeholder="Web bán hàng" name="name"
                                           value="{{ old('name') }}">
                                </div>

                                <div class="form-group">
                                    <label>Tiêu điểm</label>
                                    <label class="radio-inline">
                                        <input name="active" value="1" checked="" type="radio">Có
                                    </label>
                                    <label class="radio-inline">
                                        <input name="active" value="0" type="radio">Không
                                    </label>
                                </div>
                                {{--Hết tiêu điểm--}}

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Thêm</button>
                                </div>

                            </div>

                        </form>
                        {{-- Datatable cate --}}
                        <section class="content" style="margin-bottom: 50px">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-header">
                                            {{--<a class="btn btn-primary" id="btnadd" href="{{ route('add.products') }}" onclick="">Thêm Sản phẩm</a>--}}
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <table id="example1" class="table table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Tên</th>
                                                    <th>Thời gian</th>
                                                    <th>Hành động</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($cate_service as $value)
                                                    <tr class="odd gradeX" align="center">
                                                        <td>{{$value->name}}</td>
                                                        <td>{{$value->created_at}}</td>

                                                        <td>

                                                            <a class="btn btn-danger"
                                                               href="{{ url('admin/service/destroy-cate/'.$value->id) }}"
                                                               onclick="return confirm('Hành động sẽ xóa tin tức này! bạn có muốn tiếp tục?')">Xóa</a>
                                                            @if($value->active==1)
                                                                <a class="btn btn-info"
                                                                   href="{{ url('admin/service/setactive-cate/'.$value->id.'/0') }}"
                                                                   onclick="return confirm('Hành động sẽ ẩn Sản Phẩm này! bạn có muốn tiếp tục?')">Ẩn</a>
                                                            @else
                                                                <a class="btn btn-warning"
                                                                   href="{{ url('admin/service/setactive-cate/'.$value->id.'/1') }}"
                                                                   onclick="return confirm('Hành động sẽ hiển thị Sản Phẩm mục này! bạn có muốn tiếp tục?')">Hiển
                                                                    thị</a>

                                                            @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>


                                            </table>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                    <!-- /.box -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </section>
                        {{-- EndDatatable cate --}}

                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->


    </div>
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

@endsection

