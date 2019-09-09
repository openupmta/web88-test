@extends('admin.layouts.master-layouts')
@section('title')
    Thêm Sản Phẩm
@endsection

@section('content')
    <style>
        .addchild{
            /*border: black dotted 1px;*/
            border-radius: 10px;
            padding: 10px 10px 10px 10px;
        }
        .addchild:hover{
            box-shadow: 5px 5px 5px -1px grey;
        }
    </style>
    <div class="content-wrapper">
        <div class="container-fluid">
            <section class="content-header">
                <h1>
                    Sản Phẩm con Của "{{ $cate_parents->name }}"
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"><a href="{{ route('category_product.list') }}">Loại sản phẩm</a></li>
                    <li class="active">{{ $cate_parents->name }}</li>
                </ol>
            </section>
            <br>
            <button type="button" class="btn btn-primary" onclick="addcate()">Thêm thể loại sản phẩm</button>
            <div class="box box-primary"  id="add-cate" hidden>
                    <div class="box-body">
                        <form action="{{ route('cate_child.create') }}" method="post">
                            @csrf
                                <div class="form-group">
                                    <label for="">Thêm loại sản phẩm(*)</label>
                                    <input type="text" class="form-control" placeholder="Nhập tiêu đề" name="name" value="{{ old('name') }}" required>
                                    <input type="hidden" name="cate_id" value="{{ $cate_parents->id }}">
                                </div>
                                <div class="form-group" style="text-align: center">
                                    <hr>
                                    <input type="submit" class="btn btn-success" name="submit" value="Thêm">
                                    <input type="reset" class="btn btn-danger" onclick="return huycate('add')">
                                </div>
                        </form>
                    </div>
               {{-- <form method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sửa thể loại  (*)</label>
                            <input type="text" class="form-control" placeholder="" name="name"
                                   value="{{ $cate_id->name }}" required>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>--}}
            </div>
            <div class="box box-primary"  id="edit-cate" hidden>
                    <div class="box-body">
                        <form action="" id="form-edit" method="post">
                            @csrf
                                <div class="form-group">
                                    <label for="">Sửa loại sản phẩm(*)</label>
                                    <input type="text" class="form-control" placeholder="Nhập tiêu đề" id="cate-parentedit" name="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group" style="text-align: center">
                                    <hr>
                                    <input type="submit" class="btn btn-success" name="submit" value="Thêm">
                                    <input type="reset" class="btn btn-danger" onclick="return huycate('edit')">
                                </div>
                        </form>
                    </div>
            </div>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h1>Danh Sách Loại sản Phẩm</h1>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Tên </th>
                                        <th>Hành động</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cate_childs as $row)
                                        <tr class="odd gradeX" align="center">
                                            <td><input type="text" style="border: none; background: none;" id="value-{{ $row->id }}" value="{{ $row->name }}" readonly></td>
                                            <td>
                                                <button type="button" class="btn btn-primary" id="{{ $row->id }}" onclick="editcate({{ $row->id}})">Sửa</button>
                                                <a class="btn btn-danger" href="{{ url('/admincp/category_product/cate_child/delete/'.$row->id) }}" onclick="return confirm('Hành động sẽ xóa tin tức này! bạn có muốn tiếp tục?')">Xóa</a>
                                            </td>
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
                    <a href="{{ route('category_product.list') }}" class="btn btn-primary">Quay lại trang Loại hàng</a>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>

            <script>
                function addcate() {
                    document.getElementById('add-cate').removeAttribute('hidden');
                }
                function editcate(id) {
                    $('#cate-parentedit').val($('#value-'+id).val());
                    var editid= "'edit'";
                    var num_child= $('#num-child-'+id).val();
                    $('#form-edit').prop('action', '{{ url('/admincp/category_product/cate_child/update') }}'+'/'+id);
                    document.getElementById('edit-cate').removeAttribute('hidden');
                }

                function addchild(obj) {
                    var number= parseInt($('#num-child'+obj.id).val())+1;
                    var id= "'"+obj.id+"'";
                    var html= '<div id="child-add-'+number+'" class="form-group addchild row">';
                    html += '<div class="col-12" style="text-align: right"><button type="button" onclick="huychild('+number+','+id+')"><i class="fa fa-minus"></i></button> </div>';
                    html += '<label for="exampleInputEmail1">Thể Loại con '+ number +'(*)</label>';
                    html += '<input type="text" class="form-control" placeholder="Nhập tiêu đề" name="cate-child-'+number+'" required>';
                    html += '</div>';
                    if(number==5){
                        $('#'+obj.id).hide();
                    }
                    $('#child'+obj.id).append(html);
                    $('#num-child'+obj.id).val(number);
                }
                function huychild(number, id) {
                    var x= confirm('dữ liệu vừa nhập có thể không được giữ lại! bạn có muốn tiếp tục?');
                    if( x==true) {
                        var parent = document.getElementById("child"+id);
                        var child = document.getElementById('child-'+id+'-'+number);
                        parent.removeChild(child);
                    }
                }
                function huycate(id) {
                   var x = confirm('hành động này sẽ hủy các thao tác bạn vừa làm! bjn có tiếp tục?');
                    if(x==true){
                        $('#'+id+'-cate').prop('hidden', 'true');
                        var parent = document.getElementById("child"+id);
                        var number = $('#num-child').val();
                        for( var i=1; i<=number; i++){
                            var child = document.getElementById('child-'+id+'-'+ i);
                            parent.removeChild(child);
                        }
                        $('#num-child').val(0);
                        $('#btnadd').show();
                        return true;
                    }
                    else {
                        return false;
                    }
                }
            </script>
        </div>
    </div>


@endsection