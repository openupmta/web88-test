@extends('admins.layout.master-layout')
@section('title')
    Chỉnh sửa thông tin đối tác
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
            <section class="content-header">
                <h1>
                        Chỉnh sửa tin đối tác
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Chỉnh sửa tin đối tác</li>
                </ol>
            </section>
            <br>
            <div class="box box-primary">
                <form role="form" method="POST" action="{{Route('partner.edit',['id'=>$partner->id])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                                    
                             <div class="form-group">
                            <label>Tên (*)</label>
                            <input type="text" class="form-control" placeholder="Nhập tên" name="name"
                                   value="{{$partner->name}}">
                            <p style="color:red">{{ $errors->first('name') }}</p>
                        </div>

                        <div class="form-group">
                            <label>Đường dẫn (*)</label>
                            <input type="text" class="form-control" placeholder="Nhập đường dẫn" name="link"
                                   value="{{$partner->link}}">
                                
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Logo</label>
                            <input type="file" id="image" name="image" onchange="showIMG()">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" style="margin-left: 10px"> Ảnh hiển thị : </label>
                        <div id="viewImg">

                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{route('partner.list')}}" class="btn btn-warning">Quay lại</a>
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