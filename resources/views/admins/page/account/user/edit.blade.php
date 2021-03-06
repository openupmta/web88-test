@extends('admins.layout.master-layout')
@section('title')
    Chỉnh sửa tài khoản khách hàng
@endsection
@section('content')

    

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row" style="padding-left:10px;">
        
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Sửa thông tin</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                    <div class="table-responsive">
                <form action="{{ Route('user.account.update',['id' => $users->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <p class="text-body custom-control-p">Tên</p>
                        <input name="name" class="form-control" type="text" placeholder="Tên" value="{{ $users->name }}">
                        <p style="color:red">{{ $errors->first('name') }}</p>
                    </div>

                    <div class="form-group">
                        <p class="text-body custom-control-p">Email</p>
                        <input name="email" class="form-control" type="email" placeholder="Email" value="{{ $users->email }}" />
                        <p style="color:red">{{ $errors->first('email') }}</p>
                    </div>

                    <div class="form-group">
                        <p class="text-body custom-control-p">Phone</p>
                        <input name="phone" class="form-control" type="tel" placeholder="Email" value="{{ $users->phone }}" />
                        <p style="color:red">{{ $errors->first('email') }}</p>
                    </div>
                    <div class="form-group">
                        <p class="text-body custom-control-p">Address</p>
                        <input name="address" class="form-control" type="text" placeholder="Address" value="{{ $users->address }}" />
                        <p style="color:red">{{ $errors->first('address') }}</p>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-primary" href="{{ Route('editor.account.index') }}" type="submit" title="Cancel">Hủy</a>
                        <input name="submit" class="btn btn btn-success" type="submit" value="Cập nhật" >
                    </div>
                </form>
            </div>
                
              </div>
              <!-- /.tab-pane -->
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <

@endsection