<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['slider'] = DB::table('sliders')->orderByDesc('id')->get();
        return view('admins.pages.sliders.index', $data);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admins.pages.sliders.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('add')) {
            $this->validate($request,
                [
                    'name' => 'required|min:3',
                ],
                [
                    'name.required' => 'Tên ít nhất 3 kí tự',
                ]);

            if ($request->hasFile('image')) {

                $file = $request->file('image');

                $name = $file->getClientOriginalName();
                $image = str_random(4) . "_image_" . $name;
                while (file_exists('assets/slider-index/' . $image)) {
                    $image = str_random(4) . "_image_" . $name;
                }
                $file->move('assets/slider-index/', $image);
                $file_name = $image;

            } else {
                $file_name = 'logo1.png';
            }
            DB::table('sliders')->insert([
                'title' => $request->name,
                'image' => $file_name,
                'active' => $request->active,
                'created_at' => now(),
            ]);
            return redirect()->back()->with('thongbao', 'Thành công!');
        } else return view('admins.page.account.error');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['slider'] = DB::table('sliders')->find($id);
        if (Gate::allows('add',$data)){
            return view('admins.pages.sliders.edit', $data);
        }
        return view('admins.page.account.error');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image_update = DB::table('sliders')->where('id', '=', $id)->pluck('image');


        $this->validate($request,
            [

                'name' => 'required|min:3',

            ],
            [
                'name.required' => 'Tên ít nhất 3 kí tự',
            ]);
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $name = $file->getClientOriginalName();
            $image = str_random(4) . "_image_" . $name;
            while (file_exists('assets/slider-index/' . $image)) {
                $image = str_random(4) . "_image_" . $name;
            }
            $file->move('assets/slider-index/', $image);
            $file_name = $image;
            if (file_exists('assets/slider-index/' . $image_update[0]) && $image_update[0] != '') {
                unlink('assets/slider-index/' . $image_update[0]);
            }


        } else {
            $file_name = DB::table('sliders')->where('id', '=', $id)->pluck('image')->first();

        }

        DB::table('sliders')->where('id', '=', $id)->update([
            'title' => $request->name,
            'image' => $file_name,
            'active' => $request->active,
            'created_at' => now(),
        ]);


        return redirect()->back()->with('thongbao', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $slider = DB::table('sliders')->find($id);
        if(Gate::allows('delete',$slider))
        {
            $image_update = DB::table('sliders')->where('id', '=', $id)->pluck('image');
            if (file_exists('assets/slider-index/' . $image_update[0]) && $image_update[0] != '') {
                unlink('assets/slider-index/' . $image_update[0]);
            }
            DB::table('sliders')->where('id', '=', $id)->delete();

            return redirect()->back()->with('thongbao', 'Xóa thành công!');
        }
        else return view('admins.page.account.error');

    }

    public function setactive($id, $status)
    {
        if (Gate::allows('hide')) {
            DB::table('sliders')->where('id', '=', $id)->update([
                'active' => $status,
            ]);
            return redirect()->back()->with('thanhcong', 'Thành công');
        }
        else return view('admins.page.account.error');

    }
}
