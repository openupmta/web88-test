@extends('admins.layout.master-layout')
@section('title')
    Chỉnh sửa thông tin hỗ trợ
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
            <section class="content-header">
                <h1>
                        Chỉnh sửa tin hỗ trợ
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Chỉnh sửa tin hỗ trợ</li>
                </ol>
            </section>
            <br>
            <div class="box box-primary">
                <form role="form" method="POST" action="{{Route('supports.edit',['id'=>$supports->id])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                                    
                             <div class="form-group">
                            <label>Tên (*)</label>
                            <input type="text" class="form-control" placeholder="Nhập tên" name="name"
                                   value="{{$supports->name}}">
                            <p style="color:red">{{ $errors->first('name') }}</p>
                        </div>

                        <div class="form-group">
                            <label>Phone (*)</label>
                            <input type="tel" class="form-control" placeholder="Nhập số điện thoại" name="phone"
                                   value="{{$supports->phone}}">
                            <p style="color:red">{{ $errors->first('phone') }}</p>   
                        </div>
                        <div class="form-group">
                            <label>Email (*)</label>
                            <input type="email" class="form-control" placeholder="Nhập email" name="email"
                                   value="{{$supports->email}}">
                            <p style="color:red">{{ $errors->first('email') }}</p>   
                        </div>

                         <div class="form-group">
                            <input type="checkbox" name="active" class="custom-control-input" id="defaultUnchecked">
                            <label class="custom-control-label" for="defaultUnchecked">Active</label>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Image</label>
                            <input type="file" id="image" name="image" onchange="showIMG()">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" style="margin-left: 10px"> Ảnh hiển thị : </label>
                        <div id="viewImg">

                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{route('supports.list')}}" class="btn btn-warning">Quay lại</a>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
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
    </div>
</div>

@endsection