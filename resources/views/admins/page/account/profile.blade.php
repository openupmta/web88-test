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
        <li><a href="#">Examples</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>
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
    <!-- Main content -->
    <section class="content">

      <div class="row" style="padding-left:10px;">
            @if ( Session::has('error') )
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>{{ Session::get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
            @endif
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              
             @can('view')
                <li class="active"><a href="#activity" data-toggle="tab">Danh sách</a></li>
                <li><a href="#timeline" data-toggle="tab">Thêm</a></li>
                <li><a href="#client" data-toggle="tab">Danh sách client</a></li>
                <li><a href="#add_client" data-toggle="tab">Thêm client</a></li>
              @endcan
             
              <li @cannot('view')class="active"@endcannot><a href="#pending_web" data-toggle="tab">Web pending</a></li>
              <li><a href="#pending_blog" data-toggle="tab">Blog pending</a></li>
              <li><a href="#pending_service" data-toggle="tab">Service pending</a></li>
            </ul>
            <div class="tab-content">
            @can('view')
              <div 
              @can('view')
              class="active tab-pane" id="activity"
              @endcan
               >
                    <div class="box-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Chức năng</th>
                                        <th>Hành Động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($editor))
                                        @foreach($editor as $value )
                                            <tr class="gradeX">
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->name_level }}</td>
                                                <td >
                                                    <a class="btn btn-default" href="{{Route('editor.account.edit',['id'=> $value->id]) }}" title="Edit this user account"><i class="fas fa-pencil-ruler"></i> Sửa</a>
                                                    
                                                    <a href="{{ Route('editor.account.delete',['id' => $value->id]) }}" class="btn btn-danger" title="Xóa {{ $value->name }}" onclick="return confirm('Bạn muốn xoá tài khoản này ?')"><i class="fa fa-trash"></i> Xóa</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>


                                </table>
                            </div>
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <div class="table-responsive">
                    <form name="create" action="{{ Route('editor.account.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <p>Tên</p>
                            <input name="name" class="form-control" type="text" placeholder="Tên" value="{{ old('name') }}">
                            <p style="color:red">{{ $errors->first('name') }}</p>
                        </div>
                         <div class="form-group">
                            <p>Số điện thoại</p>
                            <input name="phone" class="form-control" type="tel" placeholder="Số điện thoại" value="{{ old('phone') }}">
                            <p style="color:red">{{ $errors->first('phone') }}</p>
                        </div>
                        <div class="form-group">
                            <p>Email</p>
                            <input name="email" class="form-control" type="email" placeholder="Email" value="{{ old('email') }}" />
                            <p style="color:red">{{ $errors->first('email') }}</p>
                        </div>
                        <div class="form-group">
                            <p>Cấp bậc</p>
                            <select name="level">
                                @foreach($roles['role'] as $value )
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <p>Mật khẩu</p>
                            <input name="password" class="form-control" id="pass" type="password" placeholder="Password" onchange="return lengthPasswword()">
                            <p style="color:red">{{ $errors->first('password') }}</p>
                            <div id="lengthpass" style="color:red"></div>
                        </div>
                        <div class="form-group">
                            <p>Nhập lại mật khẩu</p>
                            <input name="password_confirmation" class="form-control" id="confirmpass" type="password" placeholder="Confirm password" onchange="return confirmPasswword()">
                            <p style="color:red">{{ $errors->first('password_confirmation') }}</p>
                            <div id="errorpass" style="color:red"></div>
                        </div>

                        <div class="form-group">
                            <a class="btn btn-primary" href="{{ Route('editor.account.profile') }}" type="submit" title="Cancel">Hủy</a>
                            <input name="submit" class="btn btn-success" type="submit" value="Tạo" >
                        </div>

                    </form>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="client">
                <div class="box-body">
                                <table id="example3" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Hành Động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($clients))
                                        @foreach($clients['client'] as $value )
                                            <tr class="gradeX">
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td >
                                                    <a class="btn btn-default" href="{{Route('user.account.edit',['id'=> $value->id]) }}" title="Edit this user account"><i class="fas fa-pencil-ruler"></i> Sửa</a>
                                                    
                                                    <a href="{{ Route('user.account.delete',['id' => $value->id]) }}" class="btn btn-danger" title="Xóa {{ $value->name }}" onclick="return confirm('Bạn muốn xoá tài khoản này ?')"><i class="fa fa-trash"></i> Xóa</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>


                                </table>
                            </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="add_client">
               <div class="table-responsive">

                    <form name="create" action="{{ Route('user.account.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <p>Tên</p>
                            <input name="name" class="form-control" type="text" placeholder="Tên" value="{{ old('name') }}">
                            <p style="color:red">{{ $errors->first('name') }}</p>
                        </div>
                         <div class="form-group">
                            <p>Số điện thoại</p>
                            <input name="phone" class="form-control" type="tel" placeholder="Số điện thoại" value="{{ old('phone') }}">
                            <p style="color:red">{{ $errors->first('phone') }}</p>
                        </div>
                        <div class="form-group">
                            <p>Email</p>
                            <input name="email" class="form-control" type="email" placeholder="Email" value="{{ old('email') }}" />
                            <p style="color:red">{{ $errors->first('email') }}</p>
                        </div>
                        <div class="form-group">
                            <p>Address</p>
                            <input name="address" class="form-control" type="address" placeholder="Address" value="{{ old('address') }}" />
                            <p style="color:red">{{ $errors->first('address') }}</p>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-primary" href="{{ Route('editor.account.profile') }}" type="submit" title="Cancel">Hủy</a>
                            <input name="submit" class="btn btn-success" type="submit" value="Tạo" >
                        </div>

                    </form>
                </div>
              </div>
              @endcan
              <div class="tab-pane" id="pending_web">
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Image</th>
                                        <th>Link</th>
                                        <th>Pending</th>
                                        <th>Hành Ðộng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($webs['web']))
                                        @foreach($webs['web'] as $key => $value )
                                            <tr class="gradeX">
                                                <td>{{ $key+1}}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->image }}</td>
                                                <td>{{ $value->link }}</td>
                                                <th>
                                                    <div class="pendding">
                                                    
                                                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw margin-bottom"></i>
                                                        <span>Pending</span>
                                                        <select id="test" style="padding-top:5px;padding-right: 5px;" onchange="edit_pending(this,{{ $value->id }})">
                                                            <option selected disabled>--Chọn trạng thái--</option>
                                                            <option value='1'>Active</option>
                                                            <option value='0'>Pending</option>
                                                        </select>
                                                    </div>
                                                </th>
                                                <td>
                                                    <a class="btn btn-default"
                                                       href="{{Route('webstore.edit',['id'=> $value->id]) }}"
                                                       title="Edit"><i class="fas fa-pencil-ruler"></i> Sửa</a>

                                                    <a href="{{ Route('webstore.destroy',['id' => $value->id]) }}"
                                                       class="btn btn-danger" title="Xóa {{ $value->name }}"
                                                       onclick="return confirm('B?n mu?n xoá tài kho?n này ?')"><i
                                                                class="fa fa-trash"></i> Xóa</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>


                                </table>
                            </div>
              
            </div>
         
            <div class="tab-pane" id="pending_blog">
              <div class="box-body">
                                <table id="example4" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tóm tắt</th>
                                        <th>Chi tiết</th>
                                        <th>Pending</th>
                                        <th>Hành Ðộng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($blogs['blog']))
                                        @foreach($blogs['blog'] as $key => $value )
                                            <tr class="gradeX">
                                                <td>{{ $key+1}}</td>
                                                <td>{{ $value->summary }}</td>
                                                <td>{{ $value->detail }}</td>
                                                <th>
                                                    <div class="pendding">
                                                    
                                                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw margin-bottom"></i>
                                                        <span>Pending</span>
                                                        <select id="test" style="padding-top:5px;padding-right: 5px;" onchange="edit_blogs(this,{{ $value->id }})">
                                                            <option selected disabled>--Chọn trạng thái--</option>
                                                            <option value='1'>Active</option>
                                                            <option value='0'>Pending</option>
                                                        </select>
                                                    </div>
                                                </th>
                                                <td>
                                                    <a class="btn btn-default"
                                                       href="{{Route('blogs.edit',['id'=> $value->id]) }}" title="Edit"><i
                                                                class="fas fa-pencil-ruler"></i> Sửa</a>

                                                    <a href="{{ Route('blogs.destroy',['id' => $value->id]) }}"
                                                       class="btn btn-danger" title="Xóa "
                                                       onclick="return confirm('Bạn muốn xoá tài khoản này ?')"><i
                                                                class="fa fa-trash"></i> Xóa</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>


                                </table>
                            </div>
              
            </div>
             <div class="tab-pane" id="pending_service">
              <div class="box-body">
                                <table id="example5" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Image</th>
                                        <th>Tóm t?t</th>
                                        <th>Pending</th>
                                        <th>Hành Ð?ng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($services['service']))
                                        @foreach($services['service'] as $key => $value )
                                            <tr class="gradeX">
                                                <td>{{ $key+1}}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->image }}</td>
                                                <td>{{ $value->summary }}</td>
                                               <th>
                                                    <div class="pendding">
                                                    
                                                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw margin-bottom"></i>
                                                        <span>Pending</span>
                                                        <select id="test" style="padding-top:5px;padding-right: 5px;" onchange="edit_services(this,{{ $value->id }})">
                                                            <option selected disabled>--Ch?n tr?ng thái--</option>
                                                            <option value='1'>Active</option>
                                                            <option value='0'>Pending</option>
                                                        </select>
                                                    </div>
                                                </th>
                                                <td >
                                                    <a class="btn btn-default" href="{{Route('user.account.edit',['id'=> $value->id]) }}" title="Edit"><i class="fas fa-pencil-ruler"></i> S?a</a>
                                                    
                                                    <a href="{{ Route('user.account.delete',['id' => $value->id]) }}" class="btn btn-danger" title="Xóa {{ $value->name }}" onclick="return confirm('B?n mu?n xoá tài kho?n này ?')"><i class="fa fa-trash"></i> Xóa</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>


                                </table>
                            </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <script>
    function edit_pending(obj,id){
		var id_pending=obj.value;
        var id_web=id;
        var _this = obj.parentNode.parentNode.parentNode;
        console.log(_this);
        $.ajax({
            url : "update_pending",
            type : "post",
            dataType:"text",
            data : {
                _token : '{{ csrf_token() }}',
                id_pending: id_pending,
                id: id_web,
            },
            success : function (ketqua){
                if(ketqua){
                    alert('thanh cong!');
                    _this.remove();
                }
                //$('#result').html(ketqua);
            }
        });
                 
    }

    function edit_blogs(obj,id){
		var id_pending=obj.value;
        var id_web=id;
        var _this = obj.parentNode.parentNode.parentNode;
        console.log(_this);
        $.ajax({
            url : "update_pending_blogs",
            type : "post",
            dataType:"text",
            data : {
                _token : '{{ csrf_token() }}',
                id_pending: id_pending,
                id: id_web,
            },
            success : function (ketqua){
                if(ketqua){
                    alert('thanh cong!');
                    _this.remove();
                }
                //$('#result').html(ketqua);
            }
        });
                 
    }

    function edit_services(obj,id){
		var id_pending=obj.value;
        var id_web=id;
        var _this = obj.parentNode.parentNode.parentNode;
        console.log(_this);
        $.ajax({
            url : "update_pending_services",
            type : "post",
            dataType:"text",
            data : {
                _token : '{{ csrf_token() }}',
                id_pending: id_pending,
                id: id_web,
            },
            success : function (ketqua){
                if(ketqua){
                    alert('thanh cong!');
                    _this.remove();
                }
                //$('#result').html(ketqua);
            }
        });
                 
    }

</script>

@endsection