<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PartnerController extends Controller
{
    public function list()
    {
        $array['partner']=DB::table('partner')->get();

        return view('admins/page/partner/list',$array);
    }

    public function add()
    {
        return view('admins/page/partner/add');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
            ],
            [
                'name.required' => "Tên là trường bắt buộc",
            ]
        );

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $name = $file->getClientOriginalName();
            $file->move('assets/img_partner/', $name);
            $file_name = $name;
        }

        DB::table('partner')->insert([
            'name' => $request->name,
            'link' => $request->link,
            'logo' => $file_name,
            'active' => 1,
        ]);

        return redirect()->route('partner.list');
    }

    public function edit($id)
    {
        $array['partner']=DB::table('partner')->find($id);
        return view('admins/page/partner/edit',$array);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,
            [
                'name' => 'required',
            ],
            [
                'name.required' => "Tên là trường bắt buộc",
            ]
        );
        $img_old=DB::table('partner')->find($id)->logo;

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $name = $file->getClientOriginalName();

           
            if (file_exists('assets/img_partner/'.$img_old) && ($img_old !='') ) {
                unlink('assets/img_partner/' . $img_old);
            }
            $file->move('assets/img_partner/', $name);
            $file_name = $name;
        }
        else{
            $file_name=$img_old;
        }

        DB::table('partner')->where('id',$id)->update([
            'name' => $request->name,
            'link' => $request->link,
            'logo' => $file_name,
        ]);

        return redirect()->route('partner.list');
    }

    public function delete($id)
    {
        $img_old=DB::table('partner')->find($id)->logo;

        
        if (file_exists('assets/img_partner/'.$img_old) && ($img_old !='') ) {
            unlink('assets/img_partner/' . $img_old);
        }

        DB::table('partner')->where('id',$id)->delete();

        return redirect()->route('partner.list');

    }
}
