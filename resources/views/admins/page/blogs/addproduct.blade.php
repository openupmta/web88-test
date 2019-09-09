@extends('admin.layouts.master-layouts')
@section('title')
    Thêm sản phẩm
@endsection

@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1>
                    Thêm sản phẩm.
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Thêm sản phẩm</li>
                </ol>
            </section>
            <br>
            <div class="box box-primary">
                {{-- @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif --}}
                <form role="form" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name="cate_product">
                                @foreach ($cate as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm (*)</label>
                            <input type="text" class="form-control" placeholder="Nhập tiêu đề" name="name" required value="{{ old('title') }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã sản phẩm(*)</label>
                            <input class="form-control" name="code"  required
                                   placeholder="Nhập mã sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả sản phẩm(*)</label>
                            <textarea name="description" placeholder="Mô tả sản phẩm" required class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm (*)</label>
                            <input class="form-control" name="price"  required
                                   placeholder="Nhập giá sản phẩm">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng (*)</label>
                            <input class="form-control" type="number" name="quantity" required
                                   placeholder="Nhập số lượng">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Đơn vị (*)</label>
                            <select name="unit">
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sales</label>
                            <select class="form-control" name="sale">
                                <option value="0">0%</option>
                                <option value="10">10%</option>
                                <option value="20">20%</option>
                                <option value="30">30%</option>
                                <option value="40">40%</option>
                                <option value="50">50%</option>
                                <option value="60">60%</option>
                                <option value="70">70%</option>
                                <option value="70">80%</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh nền</label>
                            <input type="file" id="image" name="image" onchange="showIMG()" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" style="margin-left: 10px"> Ảnh hiển thị : </label>
                            <div id="viewImg">

                            </div>
                        </div>

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
                                document.getElementById('viewImg').innerHTML = '<img style="width:300px; height: 300px;" src="' + e.target.result + '"/>';
                            };
                            reader.readAsDataURL(fileInput.files[0]);
                        }
                    }
                }

            </script>
        </div>
    </div>
@endsection