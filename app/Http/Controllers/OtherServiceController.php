<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtherServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        $data['other_service'] = DB::table('other_service')->orderByDesc('id')->get();
        return view('admins.pages.other_service.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.pages.other_service.add');
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
            'name' => 'required|min:3|unique:other_service,name',
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
            while (file_exists('assets/img_other_service/' . $image)) {
                $image = str_random(4) . "_image_" . $name;
            }
            $file->move('assets/img_other_service/', $image);
            $file_name = $image;

        } else {
            $file_name = 'logo1.png';
        }
        DB::table('other_service')->insert([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'title' => $request->title,
            'summary' => $request->summary,
            'description' => $request->description,
            'content' => $request->contentt,
            'image' => $file_name,
            'active'=>$request->active,
            'footer_hot'=>$request->footer_hot,
            'created_at' => now()
        ]);
        $other_service_id = DB::table('other_service')->where('name', $request->name)->orderBy('id', 'desc')->first();
//Tách chuỗi
        $explode = explode(';', $request->tags);

        foreach ($explode as $ex) {
            if ($ex != "") {
                DB::table('other_service_tags')->insert([
                    'name' => $ex,
                    'other_service_id' => $other_service_id->id,
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
        $data['other_service'] = DB::table('other_service')->find($id);
        $tags = DB::table('other_service_tags')->where('other_service_id', $id)->pluck('name');
        $array = [];
        foreach ($tags as $value) {
            array_push($array, $value);
        }
        $data['str_tags'] = implode(";", $array);

        return view('admins.pages.other_service.edit',$data);
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
//        dd($request->all());
        $image_update = DB::table('other_service')->where('id', '=', $id)->pluck('image');
        DB::table('other_service_tags')->where('other_service_id', $id)->delete();
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
            while (file_exists('assets/img_other_service/' . $image)) {
                $image = str_random(4) . "_image_" . $name;
            }
            $file->move('assets/img_other_service/', $image);
            $file_name = $image;
            if (file_exists('assets/img_other_service/' . $image_update[0]) && $image_update[0] != '') {
                unlink('assets/img_other_service/' . $image_update[0]);
            }


        } else {
            $file_name = DB::table('other_service')->where('id', '=', $id)->pluck('image')->first();

        }
        DB::table('other_service')->where('id', '=', $id)->update([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'title' => $request->title,
            'summary' => $request->summary,
            'description' => $request->description,
            'content' => $request->contentt,
            'image' => $file_name,
            'footer_hot'=>$request->footer_hot,
            'updated_at' => now(),
            'active'=>$request->active,
        ]);
        $other_service_id = DB::table('other_service')->where('name', $request->name)->orderBy('id', 'desc')->first();
//Tách chuỗi
        $explode = explode(';', $request->tags);
//        dd($explode);
        foreach ($explode as $ex) {
            if ($ex != "") {
                DB::table('other_service_tags')->insert([
                    'name' => $ex,
                    'other_service_id' => $other_service_id->id,
                    'searchs' => 0,
                    'created_at'=>now()
                ]);
            }
        }

        return redirect()->route('other_service.index')->with('thongbao', 'Add Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image_update = DB::table('other_service')->where('id', '=', $id)->pluck('image');

        if (file_exists('assets/img_other_service/' . $image_update[0]) && $image_update[0] != '') {
            unlink('assets/img_other_service/' . $image_update[0]);
        }
        DB::table('other_service')->where('id','=',$id)->delete();
        return redirect()->route('other_service.index')->with('thongbao','Xóa thành công!');
    }


    public function setactive($id, $status)
    {
        DB::table('other_service')->where('id', '=', $id)->update([
            'active' => $status,
        ]);
        return redirect()->back()->with('thanhcong', 'Thành công');
    }


}
