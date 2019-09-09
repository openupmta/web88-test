@extends('admins.layout.master-layout')
@section('title')
    Kho giao diện
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1>
                    Kho giao diện
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Kho giao diện</li>
                </ol>
            </section>
            <br>
            <div class="box box-primary">

                <div class="box-header">
                    <a style="text-align: left" href="{{route('webstore.createCate')}}" class="btn btn-success">Thêm thể loại</a>
                    <a style="text-align: right;" href="{{route('webstore.index')}}" class="btn btn-primary">Danh sách</a>
                </div>
                <form role="form" method="POST" action="{{route('webstore.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name="cate_news">
                                {{--@foreach($cate_news as $cate)--}}
                                    {{--<option value="{{$cate->id}}">{{$cate->name}}</option>--}}
                                {{--@endforeach--}}
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu đề tin tức (*)</label>
                            <input type="text" class="form-control" placeholder="Nhập tiêu đề" name="name"
                                   value="{{ old('title') }}">
                        </div>
                        <label for="exampleInputEmail1">Tóm tắt tin tức (*)</label>
                        <div class="form-group">

                            <textarea class="form-control" name="summary" cols="50" rows="10"
                                      placeholder="Nhập tóm tắt nội dung">{{ old('summary') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nội dung (*)</label>
                            <textarea name="contentt" rows="10" placeholder="Nhập nội dung"
                                      class="form-control">{{ old('content') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh nền</label>
                            <input type="file" id="image" name="image" onchange="showIMG()">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" style="margin-left: 10px"> Ảnh hiển thị : </label>
                        <div id="viewImg">

                        </div>
                    </div>

                    {{-- tag --}}
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Tags</label>
                            <input data-role='tags-input' value="Talentwins" name="tags">
                        </div>
                    </div>
                    {{-- endtag --}}
                    {{--Tiêu điểm --}}
                    <div class="form-group">
                        <label>Tiêu điểm</label>
                        <label class="radio-inline">
                            <input name="focus" value="1" checked="" type="radio">Có
                        </label>
                        <label class="radio-inline">
                            <input name="focus" value="0" type="radio">Không
                        </label>
                    </div>
                    {{--Hết tiêu điểm--}}

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>

            <script>
                CKEDITOR.replace('contentt', {
                    filebrowserBrowseUrl: '{{asset("")}}ckfinder/ckfinder.html',
                    filebrowserImageBrowseUrl: '{{asset("")}}ckfinder/ckfinder.html?type=Images',
                    filebrowserFlashBrowseUrl: '{{asset("")}}ckfinder/ckfinder.html?type=Flash',
                    filebrowserUploadUrl: '{{asset("")}}ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    filebrowserImageUploadUrl: '{{asset("")}}ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                    filebrowserFlashUploadUrl: '{{asset("")}}ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                });


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
        </div>
    </div>
@endsection