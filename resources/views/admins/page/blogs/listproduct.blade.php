@extends('admin.layouts.master-layouts')
@section('title')
    Danh sách tin tức
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <style>
            .input{
                background: none;
                border: none;
            }
        </style>
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
        <section class="content-header">
            <h1>
                Danh Sách sản phẩm
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Sản phẩm</li>
            </ol>
        </section>
        <section class="content">
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
                                    <th>Tên sản phẩm </th>
                                    <th>Mã sản phẩm</th>
                                    <th>Ảnh</th>
                                    <th>Thể loại</th>
                                    <th>Thời gian </th>
                                    {{--<th>Trạng thái </th>--}}
                                    <th>Trạng thái</th>
    
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $row)
                                    <tr class="odd gradeX" align="center">
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->code}}</td>
                                        <td><img width="100px" src="{{ asset('images/img/'.$row->image) }}"> </td>
                                        <td>{{$row->cate}}</td>
                                        <td>{{$row->created_at}}</td>
                                        <td>
                                           @if ($row->quantity > 0)
                                                Còn Hàng
                                           @else
                                               Hết Hàng
                                           @endif
                                        </td>

                                        <td>
    
                                            <a class="btn btn-primary" id="edit" href="{{ url('admincp/product/edit-product/'.$row->id) }}" onclick="">Sửa</a>
                                            {{--@if($value->status==1)--}}
                                                {{--<a class="btn btn-danger" href="{{ url('admincp/news/setactive/'.$value->id.'/0') }}" onclick="return confirm('Hành động sẽ ẩn Sản Phẩm này! bạn có muốn tiếp tục?')">Ẩn</a>--}}
                                            {{--@else--}}
                                                {{--<a class="btn btn-success" href="{{ url('admincp/news/setactive/'.$value->id.'/1') }}" onclick="return confirm('Hành động sẽ hiển thị Sản Phẩm mục này! bạn có muốn tiếp tục?')">Hiển thị</a>--}}
    
                                            {{--@endif--}}
                                            <a class="btn btn-danger" href="{{ url('admincp/product/del-product/'.$row->id) }}" onclick="return confirm('Hành động sẽ xóa tin tức này! bạn có muốn tiếp tục?')">Xóa</a>
                                            {{-- <a class="btn btn-success" href="" > Xem</a> --}}
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
     {{--   <script>
            function update(id) {
                var input= document.querySelector('#name'+id);
                var edit= document.querySelector('#edit'+id);
                var active= document.querySelector('#active'+id);
    
    
                input.removeAttribute('readonly');
                input.classList.remove('input');
                input.classList.add('form-control');
                edit.classList.add('hide');
                active.classList.remove('hide');
            }
    
            function huyupdate(id) {
                var r = confirm("WARNING! You have unsaved changes that may be lost!");
                if (r == true) {
                    var input = document.querySelector('#name' + id);
                    var edit = document.querySelector('#edit' + id);
                    var active= document.querySelector('#active'+id);
    
    
                    input.classList.add('input');
                    $('.input').prop('readonly', true);
                    input.classList.remove('form-control');
                    edit.classList.remove('hide');
                    active.classList.add('hide');
    
                }
                else{
                    return false;
                }
            }
        </script>--}}
    
    </div>
</div>

@endsection