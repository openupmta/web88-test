<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class blogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $data['blogs'] = DB::table('blogs')
            ->select('blogs.*', 'cate_blogs.name as cate_blogs')
            ->join('cate_blogs', 'blogs.cate_id', '=', 'cate_blogs.id')
            ->orderByDesc('id')
            ->get();

        return view('admins.pages.blogs.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('add')) {
            $data['cate_blogs'] = DB::table('cate_blogs')->get();
            return view('admins.pages.blogs.add', $data);
        } else {
            return view('admins.page.account.error');
        }
    }


    public function createCate()
    {
        if (Gate::allows('add')) {
            $data['cate_blogs'] = DB::table('cate_blogs')->get();
            return view('admins.pages.blogs.cate', $data);
        } else {
            return view('admins.page.account.error');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
            while (file_exists('assets/img_blogs/' . $image)) {
                $image = str_random(4) . "_image_" . $name;
            }
            $file->move('assets/img_blogs/', $image);
            $file_name = $image;

        } else {
            $file_name = 'logo1.png';
        }
        DB::table('blogs')->insert([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'image' => $file_name,
            'summary'=>$request->summary,
            'detail'=>$request->contentt,
            'cate_id' => $request->cate_blogs,
            'active' => $request->active,
            'admin_id'=> Auth::user()->id,
            'footer_hot'=>$request->footer_hot,
            'created_at' => now(),
        ]);
        return redirect()->back()->with('thongbao', 'Thành công!');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeCate(Request $request)
    {

        $this->validate($request,
            [

                'name' => 'required|min:3|unique:cate_blogs',
            ],
            [

            ]);


        DB::table('cate_blogs')->insert([
            'name' => $request->name,

            'active' => $request->active,
            'created_at' => now(),
        ]);
        return redirect()->back()->with('thongbao', 'Thành công!');

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
        $data['blogs'] = DB::table('blogs')->find($id);
        if (Gate::allows('edit', $data)) {
            $data['cate_blogs'] = DB::table('cate_blogs')->get();
            return view('admins.pages.blogs.edit', $data);
        } else {
            return view('admins.page.account.error');
        }


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

        $image_update = DB::table('blogs')->where('id', '=', $id)->pluck('image');


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
            while (file_exists('assets/img_blogs/' . $image)) {
                $image = str_random(4) . "_image_" . $name;
            }
            $file->move('assets/img_blogs/', $image);
            $file_name = $image;
            if (file_exists('assets/img_blogs/' . $image_update[0]) && $image_update[0] != '') {
                unlink('assets/img_blogs/' . $image_update[0]);
            }


        } else {
            $file_name = DB::table('blogs')->where('id', '=', $id)->pluck('image')->first();

        }

        DB::table('blogs')->where('id', '=', $id)->update([
            'name' => $request->name,
            'slug'=>str_slug($request->name),
            'image' => $file_name,
            'summary'=>$request->summary,
            'detail'=>$request->contentt,
            'cate_id' => $request->cate_blogs,
            'active' => $request->active,
            'admin_id'=> Auth::user()->id,
            'footer_hot'=>$request->footer_hot,
            'created_at' => now(),
        ]);


        return redirect()->route('blogs.index')->with('thongbao', 'Add Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image_update = DB::table('blogs')->where('id', '=', $id)->pluck('image');
        if (file_exists('assets/img_blogs/' . $image_update[0]) && $image_update[0] != '') {
            unlink('assets/img_blogs/' . $image_update[0]);
        }
        DB::table('blogs')->where('id', '=', $id)->delete();

        return redirect()->route('blogs.index')->with('thongbao', 'Xóa thành công!');
    }

    public function destroyCate($id)
    {

        DB::table('cate_blogs')->where('id', '=', $id)->delete();

        return redirect()->back()->with('thongbao', 'Xóa thành công!');
    }

    public function setactive($id, $status)
    {
        DB::table('blogs')->where('id', '=', $id)->update([
            'active' => $status,
        ]);
        return redirect()->back()->with('thanhcong', 'Thành công');
    }

    public function setactiveCate($id, $status)
    {
        DB::table('cate_blogs')->where('id', '=', $id)->update([
            'active' => $status,
        ]);
        return redirect()->back()->with('thanhcong', 'Thành công');
    }
}
