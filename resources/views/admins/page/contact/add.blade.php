@extends('admins.layout.master-layout')
@section('title')
    Thêm liên hệ
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1>
                    Thêm liên hệ.
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Thêm liên hệ</li>
                </ol>
            </section>
            <br>
            <div class="box box-primary">
                <div class="box-header">
                    <a href="{{route('contact.list')}}" class="btn btn-primary">Danh sách</a>
                </div>
                <form role="form" method="POST" action="{{route('contact.add')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">

                        <div class="form-group">
                            <label>Title (*)</label>
                            <input type="text" class="form-control" placeholder="Nhập tên" name="title"
                                   value="{{ old('title') }}">
                            <p style="color:red">{{ $errors->first('title') }}</p>
                        </div>

                        <div class="form-group">
                            <label>Mã số thuế  (*)</label>
                            <input type="text" class="form-control" placeholder="Nhập mã số thuế" name="masothue"
                                   value="{{ old('masothue') }}">
                            <p style="color:red">{{ $errors->first('masothue') }}</p>
                        </div>

                        <div class="form-group">
                            <label>Phone (*)</label>
                            <input type="tel" class="form-control" placeholder="Nhập số điện thoại" name="phone"
                                   value="{{ old('phone') }}">
                            <p style="color:red">{{ $errors->first('phone') }}</p>
                        </div>

                        <div class="form-group">
                            <label>Email (*)</label>
                            <input type="email" class="form-control" placeholder="Nhập email" name="email"
                                   value="{{ old('email') }}">
                            <p style="color:red">{{ $errors->first('email') }}</p>
                        </div>
                        <div class="form-group">
                            <label>Address (*)</label>
                            <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="address"
                                   value="{{ old('address') }}">
                            <p style="color:red">{{ $errors->first('address') }}</p>
                        </div>
                        <div class="form-group">
                            <label>Website (*)</label>
                            <input type="text" class="form-control" placeholder="Nhập tên website" name="website"
                                   value="{{ old('website') }}">
                            <p style="color:red">{{ $errors->first('website') }}</p>
                        </div>

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