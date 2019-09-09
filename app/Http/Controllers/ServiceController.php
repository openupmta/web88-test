<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        $data['service'] = DB::table('service')->orderByDesc('id')->get();
        return view('admins.pages.service.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.pages.service.add');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|min:3',
            'title' => 'required',
            'description' => 'required|min:3|max:255',
            'contentt' => 'required',
            'summary' => 'required',
            'tags' => 'required',

        ], [
            'name.required' => 'Tên dịch vụ không được xác định',
            'name.min' => 'Tên dịch vụ không được ít hơn 3 kí tự',
            'title.required' => 'Tiêu đề dịch vụ không được để trống',
            'description.required' => 'Mô tả không được để trống.',
            'description.min' => 'Mô tả không được ít hơn 3 kí tự.',
            'description.max' => 'Mô tả không được vượt quá 255 ký tự.',
            'summary.required' => 'Tóm tắt chưa được xác định',
            'contentt.required' => 'Nội dung không được xác định',
            'tags.required' => 'Thể loại không được xác định',

        ]);
//Kiểm tra định dạng ảnh
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $name = $file->getClientOriginalName();
            $image = str_random(4) . "_image_" . $name;
            while (file_exists('assets/img_service/' . $image)) {
                $image = str_random(4) . "_image_" . $name;
            }
            $file->move('assets/img_service/', $image);
            $file_name = $image;

        } else {
            $file_name = 'logo1.png';
        }

        DB::table('service')->insert([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'title' => $request->title,
            'summary' => $request->summary,
            'description' => $request->description,
            'content' => $request->contentt,
            'image' => $file_name,
//            'cate_id' => $request->cate_service,
//            'focus' => $request->focus,
            'active'=>$request->active,
            'created_at' => now(),
            'footer_hot'=>$request->footer_hot,
        ]);
        $service_id = DB::table('service')->where('name', $request->name)->orderBy('id', 'desc')->first();
//Tách chuỗi
        $explode = explode(';', $request->tags);

        foreach ($explode as $ex) {
            if ($ex != "") {
                DB::table('service_tags')->insert([
                    'name' => $ex,
                    'service_id' => $service_id->id,
                    'searchs' => 0,
                    'created_at'=>now()
                ]);
            }
        }

        return redirect()->back()->with('thongbao', 'Add Success');
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['service'] = DB::table('service')->find($id);
        $tags = DB::table('service_tags')->where('service_id', $id)->pluck('name');
        $array = [];
        foreach ($tags as $value) {
            array_push($array, $value);
        }
        $data['str_tags'] = implode(";", $array);

        return view('admins.pages.service.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $image_update = DB::table('service')->where('id', '=', $id)->pluck('image');
        DB::table('service_tags')->where('service_id', $id)->delete();
        $this->validate($request, [
            'name' => 'required|min:3',
            'title' => 'required',
            'description' => 'required|min:3|max:255',
            'contentt' => 'required',
            'summary' => 'required',
            'tags' => 'required',


        ], [
            'name.required' => 'Tên dịch vụ không được xác định',
            'name.min' => 'Tên dịch vụ không được ít hơn 3 kí tự',
            'title.required' => 'Tiêu đề dịch vụ không được để trống',
            'description.required' => 'Mô tả không được để trống.',
            'description.min' => 'Mô tả không được ít hơn 3 kí tự.',
            'description.max' => 'Mô tả không được vượt quá 255 ký tự.',
            'summary.required' => 'Tóm tắt chưa được xác định',
            'contentt.required' => 'Nội dung không được xác định',
//            'image.required' => 'Ảnh không được xác định',
            'tags.required' => 'Thể loại không được xác định',

        ]);
//Kiểm tra định dạng ảnh
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $name = $file->getClientOriginalName();
            $image = str_random(4) . "_image_" . $name;
            while (file_exists('assets/img_service/' . $image)) {
                $image = str_random(4) . "_image_" . $name;
            }
            $file->move('assets/img_service/', $image);
            $file_name = $image;
            if (file_exists('assets/img_service/' . $image_update[0]) && $image_update[0] != '') {
                unlink('assets/img_service/' . $image_update[0]);
            }


        } else {
            $file_name = DB::table('service')->where('id', '=', $id)->pluck('image')->first();

        }
        DB::table('service')->where('id', '=', $id)->update([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'title' => $request->title,
            'summary' => $request->summary,
            'description' => $request->description,
            'content' => $request->contentt,
            'image' => $file_name,
            'updated_at' => now(),
            'footer_hot'=>$request->footer_hot,
            'active'=>$request->active,
        ]);
        $service_id = DB::table('service')->where('name', $request->name)->orderBy('id', 'desc')->first();
//Tách chuỗi
        $explode = explode(';', $request->tags);

        foreach ($explode as $ex) {
            if ($ex != "") {
                DB::table('service_tags')->insert([
                    'name' => $ex,
                    'service_id' => $service_id->id,
                    'searchs' => 0,
                    'created_at'=>now()
                ]);
            }
        }

        return redirect()->route('service.index')->with('thongbao', 'Add Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image_update = DB::table('service')->where('id', '=', $id)->pluck('image');

        if (file_exists('assets/img_service/' . $image_update[0]) && $image_update[0] != '') {
            unlink('assets/img_service/' . $image_update[0]);
        }
        DB::table('service')->where('id','=',$id)->delete();
        return redirect()->route('service.index')->with('thongbao','Xóa thành công!');
    }


    public function setactive($id, $status)
    {
        DB::table('service')->where('id', '=', $id)->update([
            'active' => $status,
        ]);
        return redirect()->back()->with('thanhcong', 'Thành công');
    }


}
