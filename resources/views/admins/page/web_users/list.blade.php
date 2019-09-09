@extends('admins.layout.master-layout')
@section('title')
    Danh sách khách hàng cần liên hệ
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
            <section class="content-header">
                <h1>
                    Danh sách khách hàng cần liên hệ
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Danh sách khách hàng cần liên hệ</li>
                </ol>
            </section>
            <hr>

            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="col-md-2">Tên khách hàng </th>
                                        <th class="col-md-2">Số điện thoại</th>
                                        <th class="col-md-2">Eamil</th>
                                        {{--  <th class="col-md-2">Địa chỉ</th>  --}}
                                        <th class="col-md-2">Tên web</th>
                                        <th class="col-md-3">Tiêu đề</th>
                                        <th class="col-md-3">Nội dung</th>
                                        <th class="col-md-3">Trạng thái</th>
                                        <th class="col-md-3">Chi tiết</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($web_users as $value)
                                        <tr class="odd gradeX" >
                                            <td >{{$value->name_users}}</td>
                                            <td >{{$value->phone}}</td>
                                            <td >{{$value->email}}</td>
                                            {{--  <td >{{$value->address}}</td>  --}}
                                            <td >{{$value->name_web}}</td>
                                            <td >{{$value->title}}</td>
                                            <td >{{$value->content}}</td>
                                            <td>
                                            
                                            @if ($value->status == 3)
                                                <div class="pendding">                                 
                                                    &emsp;<i style="color:orange" class="glyphicon glyphicon-off"></i>
                                                    <span style="color:red">&emsp;Failed&emsp;</span>
                                                    <select id="test" style="padding-top:5px;padding-right: 5px;" onchange="edit_pending(this,{{$value->users_id}},{{$value->web_id}})">
                                                        <option {{ $value->status == 1 ? 'selected' : '' }} value='1'>Đang đàm phán</option>
                                                        <option {{ $value->status == 2 ? 'selected' : '' }} value='2'>Thành công</option>
                                                        <option {{ $value->status == 3 ? 'selected' : '' }} value='3'>Không thành công</option>
                                                    </select>
                                                </div>
                                            @else
                                                <div class="pendding">                                 
                                                    &emsp;<i style="color:#0c3f50" class="fa fa-spinner fa-pulse fa-1x fa-fw margin-bottom"></i>
                                                    <span style="color:blue">Pending&emsp;</span>
                                                    <select id="test" style="padding-top:5px;padding-right: 5px;" onchange="edit_pending(this,{{$value->users_id}},{{$value->web_id}})">
                                                        <option {{ $value->status == 0 ? 'selected' : '' }} disabled>Pending</option>
                                                        <option {{ $value->status == 1 ? 'selected' : '' }} value='1'>Đang đàm phán</option>
                                                        <option {{ $value->status == 2 ? 'selected' : '' }} value='2'>Thành công</option>
                                                        <option {{ $value->status == 3 ? 'selected' : '' }} value='3'>Không thành công</option>
                                                    </select>
                                                </div>
                                            @endif
                                                
                                            </td>
                                            <td ><a href="{{url('admin/web_users/detail'.'/'.$value6->web_id.'/'.$value->users_id)}}"><button class="btn btn-primary">Xem</button></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <b></b>
    </div>
</div>

 <script language="JavaScript">
        function confirmAction() {
            return confirm("Bạn có chắc chắn không ?")
        }
</script>

 <script>
    function edit_pending(obj,users_id,web_id){
        var id_pending=obj.value;
        var users_id=users_id;
        var web_id=web_id;
        var c=obj.parentNode.children[1];
        
        $.ajax({
            url : "edit_pending",
            type : "post",
            dataType:"text",
            data : {
                _token : '{{ csrf_token() }}',
                id_pending: id_pending,
                web_id: web_id,
                users_id:users_id,
            },
            success : function (ketqua){
                if(ketqua){
                    alert('Thay đổi thành công');
                }
            }
        });
        if (id_pending==1){        
            obj.parentNode.firstChild.nextElementSibling.setAttribute('class','fa fa-spinner fa-pulse fa-2x fa-fw margin-bottom');
            c.innerHTML="Pending";
        }
        if (id_pending==2){
            obj.parentNode.parentNode.parentNode.remove();
        }
        
        if (id_pending==3){      
            obj.parentNode.firstChild.nextElementSibling.setAttribute('class','glyphicon glyphicon-off');
            c.innerHTML=" &emsp; Failed  &emsp;";
        }
    }
</script>


@stop