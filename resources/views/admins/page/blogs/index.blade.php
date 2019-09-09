@extends('admin.layouts.master-layouts')
@section('title')
    Danh sách Sản Phẩm
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
                                            <th>Tên sản phẩm </th>
                                            <th>Mã sản phẩm</th>
                                            <th>Ảnh</th>
                                            <th>Thể loại</th>
                                            <th>Thời gian </th>
                                            <th>Trạng thái </th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
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
                                                @if ($row->status == 0)
                                                    Ẩn
                                                @else
                                                    Hiển thị
                                                @endif
                                            </td>

                                            <td>

                                                <a class="btn btn-primary" id="edit" href="{{ url('admincp/product/edit-product/'.$row->id) }}" onclick="">Sửa</a>
                                               @if($row->status==1)
                                                <a class="btn btn-danger" href="{{ url('admincp/news/setactive/'.$row->id.'/0') }}" onclick="return confirm('Hành động sẽ ẩn Sản Phẩm này! bạn có muốn tiếp tục?')">Ẩn</a>
                                                @else
                                                <a class="btn btn-success" href="{{ url('admincp/news/setactive/'.$row->id.'/1') }}" onclick="return confirm('Hành động sẽ hiển thị Sản Phẩm mục này! bạn có muốn tiếp tục?')">Hiển thị</a>

                                                @endif
                                                <a class="btn btn-danger" href="{{ url('admincp/product/del-product/'.$row->id) }}" onclick="return confirm('Hành động sẽ xóa tin tức này! bạn có muốn tiếp tục?')">Xóa</a>
                                             <a class="btn btn-success" href="" > Xem</a> 
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Tên sản phẩm </th>
                                        <th>Mã sản phẩm</th>
                                        <th>Ảnh</th>
                                        <th>Thể loại</th>
                                        <th>Thời gian </th>
                                        <th>Trạng thái </th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </tfoot>

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

        </div>
    </div>


@endsection