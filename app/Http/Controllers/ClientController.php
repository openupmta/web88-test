<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DB;
use Session;
use App\Model\admin;

class ClientController extends Controller
{
    public function profile()
    {
        $admin=new admin();
        //if(Gate::allows('view')){
            $editor['editor'] = DB::table('admin')          

            ->join("role", "role.id", "=", "admin.level")

            ->select( 'role.name as name_level','role.id as role_id','admin.*' ) 

            ->get();
            $array = array(
                'roles' => array(
                    'role'=>DB::table('role')->get(),
                ),
                'clients' => array(
                    'client'=>DB::table('users')->get(),
                ),
                'webs' => array(
                    'web'=>DB::table('web')->where('active','0')->get(),
                ),
                'blogs' => array(
                    'blog'=>DB::table('blogs')->where('active','0')->get(),
                ),
                'services' => array(
                    'service'=>DB::table('service')->where('active','0')->get(),
                )
            );
            // $role['role']=DB::table('role')->get();

            // $client['client']= DB::table('users')->get();
            return view('admins.page.account.profile',$editor,$array);
    }

    public function store(Request $request)
    {   
        $this->validate($request,
               [
                'name' =>'required',
                'phone' =>'required|numeric',
                'email' =>'required|email',
                'address' => 'required|min:6',
               ],
               [
                'name.required' => 'Tên admin là trường bắt buộc',
                'phone.required' => 'Số điện thoại là trường bắt buộc',
                'phone.numeric' => 'Viết sai số điện thoại',
                'email.required' => 'Email là trường bắt buộc',
                'email.email' => 'Email không đúng định dạng',
                'address.required' => 'Địa chỉ là trường bắt buộc',
               ]);
        
        $email=DB::table('users')->pluck('email');
        $phone=DB::table('users')->pluck('phone');
        foreach ($email as $value) {
            if($value==$request->input('email')){
                Session::flash('error','Tài khoản này đã tồn tại!');
                return redirect('admin/account/editor/profile')->withInput();
            }
        }
        foreach ($phone as $value) {
            if($value==$request->input('phone')){
                Session::flash('error','Tài khoản này đã tồn tại!');
                return redirect('admin/account/editor/profile')->withInput();
            }
        }

        DB::table('users')->insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'created_at' => now(),
        ]);

        return redirect()->route('editor.account.profile');
    }

    public function edit($id)
    {
        $users['users']=DB::table('users')->find($id);
        return view('admins.page.account.user.edit',$users);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,
               [
                'name' =>'required',
                'phone' =>'required|numeric',
                'email' =>'required|email',
                'address' => 'required|min:6',
               ],
               [
                'name.required' => 'Tên admin là trường bắt buộc',
                'phone.required' => 'Số điện thoại là trường bắt buộc',
                'phone.numeric' => 'Viết sai số điện thoại',
                'email.required' => 'Email là trường bắt buộc',
                'email.email' => 'Email không đúng định dạng',
                'address.required' => 'Địa chỉ là trường bắt buộc',
               ]);
               

         // kiểm tra email và phone mới có phải email cũ không
        $email_old=DB::table('users')->find($id)->email;
        $phone_old=DB::table('users')->find($id)->phone;
         //nếu là email cũ thì kiểm tra phone có phải phone cũ không 
             //nếu là phone cũ thì update
             //nếu là phone mới thì lấy bản ghi các số trong admin để đối chiếu tránh trùng tài khoản
        //trường hợp còn lại làm tương tự 
        if ( $email_old==$request->input("email")) {
            if ( $phone_old==$request->input("phone")) {
                DB::table('users')->where('id',$id)->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                    'updated_at' => now(),
                ]);
            }
            else{
                $phone=DB::table('users')->select('phone')->pluck('phone');
                foreach ($phone as $value) {
                    if($value==$request->input('phone')){
                        Session::flash('error','Tài khoản này đã tồn tại!');
                        return redirect()->route('user.account.edit',['id'=>$id])->withInput();
                    }
                }
                DB::table('users')->where('id',$id)->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                    'updated_at' => now(),
                ]);
            }
        }
        else{

            if ( $phone_old==$request->input("phone")) {
                DB::table('users')->where('id',$id)->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                    'updated_at' => now(),
                ]);
            }
            else{
                $phone=DB::table('users')->select('phone')->pluck('phone');
                foreach ($phone as $value) {
                    if($value==$request->input('phone')){
                        Session::flash('error','Tài khoản này đã tồn tại!');
                        return redirect()->route('user.account.edit',['id'=>$id])->withInput();
                    }
                }
                DB::table('users')->where('id',$id)->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                    'updated_at' => now(),
                ]);
            }

            $email=DB::table('users')->select('email')->pluck('email');
            foreach ($email as $value) {
                if($value==$request->input('email')){
                    Session::flash('error','Tài khoản này đã tồn tại!');
                    return redirect()->route('user.account.edit',['id'=>$id])->withInput();
                }
            }
            DB::table('users')->where('id',$id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'updated_at' => now(),
            ]);
        }
        
        return redirect()->route('editor.account.index');
    }

    public function delete($id)
    {
        DB::table('users')->where('id',$id)->delete();
        return redirect()->route('editor.account.index');
    }
}
