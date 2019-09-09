<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use DB;

class SupportsController extends Controller
{
    public function list()
    {
        $array['supports']=DB::table('supports')->get();

        return view('admins/page/supports/list',$array);
    }

    public function add()
    {
        return view('admins/page/supports/add');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'phone' => 'required|numeric',
                'email' => 'required|unique:supports,email',
            ],
            [
                'name.required' => "Tên là trường bắt buộc",
                'phone.required' => "Số điện thoại là trường bắt buộc",
                'name.numeric' => "Viết sai số điện thoại",
                'email.required' => "Email là trường bắt buộc",
                'email.email' => "Sai định dạng email",
            ]
        );


        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $name = $file->getClientOriginalName();
            $image = str_random(4) . "_image_" . $name;
            while (file_exists('assets/img_supports/' . $image)) {
                $image = str_random(4) . "_image_" . $name;
            }
            $file->move('assets/img_supports/', $image);
            $file_name = $image;

        } else {
            $file_name = 'logo1.png';
        }

        DB::table('supports')->insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'image' => $file_name,
            'active' => 1,
        ]);

        return redirect()->route('supports.list');
    }

    public function edit($id)
    {
        $array['supports']=DB::table('supports')->find($id);
        return view('admins/page/supports/edit',$array);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'phone' => 'required|numeric',
                'email' => 'required|email',
            ],
            [
                'name.required' => "Tên là trường bắt buộc",
                'phone.required' => "Số điện thoại là trường bắt buộc",
                'name.numeric' => "Viết sai số điện thoại",
                'email.required' => "Email là trường bắt buộc",
                'email.email' => "Sai định dạng email",
            ]
        );
        $img_old=DB::table('supports')->find($id)->image;

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $name = $file->getClientOriginalName();

           
            if (file_exists('assets/img_supports/'.$img_old) && ($img_old !='') ) {
                unlink('assets/img_supports/' . $img_old);
            }
            $file->move('assets/img_supports/', $name);
            $file_name = $name;
        }
        else{
            $file_name=$img_old;
        }
        if ($request->active=="null") {
            $active=0;
        }
        else{
            $active=1;
        }

        DB::table('supports')->where('id',$id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'image' => $file_name,
            'active' => $active,
        ]);

        return redirect()->route('supports.list');
    }

    public function delete($id)
    {
        $img_old=DB::table('supports')->find($id)->image;

        
        if (file_exists('assets/img_supports/'.$img_old) && ($img_old !='') ) {
            unlink('assets/img_supports/' . $img_old);
        }

        DB::table('supports')->where('id',$id)->delete();

        return redirect()->route('supports.list');

    }
}
