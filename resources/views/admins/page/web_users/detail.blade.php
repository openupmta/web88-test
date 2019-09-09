@extends('admins.layout.master-layout')
@section('title')
    Chi tiết thông tin khách hàng liên hệ
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
            <section class="content-header">
                <h1>
                    Chi tiết thông tin khách hàng liên hệ
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Chi tiết thông tin khách hàng liên hệ</li>
                </ol>
            </section>
            <br>
            <div class="box box-primary">
                
                    @csrf
                    <div class="box-body">
                    <table>
                    <tr>
                        <div class="form-group">
                            <label>Tên khách hàng (*)</label>
                            <input readonly  type="text" class="form-control" placeholder="Nhập tên" name="name"
                                   value="{{$web_users->name_users}}">
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <label>Phone (*)</label>
                            <input readonly type="tel" class="form-control" placeholder="Nhập số điện thoại" name="phone"
                                   value="{{$web_users->phone}}">   
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <label>Email (*)</label>
                            <input readonly type="email" class="form-control" placeholder="Nhập email" name="email"
                                   value="{{$web_users->email}}">  
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <label>Tên web (*)</label>
                            <input readonly type="text" class="form-control" placeholder="Nhập tên" name="name"
                                   value="{{$web_users->name_web}}">
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <label>Title (*)</label>
                            <input readonly type="text" class="form-control" placeholder="Nhập tên" name="name"
                                   value="{{$web_users->title}}">
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <label>Nội dung (*)</label>
                           <textarea readonly class="form-control" cols="50" rows="10">{{$web_users->content}}</textarea>
                        </div>
                    </tr>
                    <tr>
                    <div class="box-footer">
                        <a href="{{Route('web_users.contact')}}" class="btn btn-warning">Quay lại</a>
                    </div>
                    </tr>
                </table>
            </div>

    </div>
</div>

@endsection