<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class WebStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $data['web'] = DB::table('web')
            ->select('web.*', 'cate_web.name as cate_web')
            ->join('cate_web', 'web.cate_id', '=', 'cate_web.id')
            ->orderByDesc('id')
            ->get();

        return view('admins.pages.webstore.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['cate_web'] = DB::table('cate_web')->get();
        return view('admins.pages.webstore.add', $data);

    }


    public function createCate()
    {
        $data['cate_web'] = DB::table('cate_web')->orderByDesc('id')->get();
        return view('admins.pages.webstore.cate', $data);

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
            $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
            $this->validate($request,
                [

                    'name' => 'required|min:3',
                    'link' => 'required|regex:' . $regex,
                ],
                [
                    'name.required' => 'Tên ít nhất 3 kí tự',
                ]);

            if ($request->hasFile('image')) {

                $file = $request->file('image');

                $name = $file->getClientOriginalName();
                $image = str_random(4) . "_image_" . $name;
                while (file_exists('assets/img_webs/' . $image)) {
                    $image = str_random(4) . "_image_" . $name;
                }
                $file->move('assets/img_webs/', $image);
                $file_name = $image;

            } else {
                $file_name = 'logo1.png';
            }
            DB::table('web')->insert([
                'name' => $request->name,
                'slug' => str_slug($request->name),
                'image' => $file_name,
                'link' => $request->link,
                'cate_id' => $request->cate_web,
                'active' => $request->active,
                'created_at' => now(),
            ]);
            return redirect()->back()->with('thongbao', 'Thành công!');
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
    public function storeCate(Request $request)
    {
        if (Gate::allows('add')) {
            $this->validate($request,
                [

                    'name' => 'required|min:3|unique:cate_web',
                ],
                [

                ]);
            if ($request->hasFile('image')) {

                $file = $request->file('image');

                $name = $file->getClientOriginalName();
                $image = str_random(4) . "_image_icon" . $name;
                while (file_exists('assets/img_icon/' . $image)) {
                    $image = str_random(4) . "_image_" . $name;
                }
                $file->move('assets/img_icon/', $image);
                $file_name = $image;

            } else {
                $file_name = 'logo1.png';
            }

            DB::table('cate_web')->insert([
                'name' => $request->name,
                'slug' => str_slug($request->name),
                'icon' => $file_name,
                'active' => $request->active,
                'created_at' => now(),
            ]);
            return redirect()->back()->with('thongbao', 'Thành công!');
        } else return view('admins.page.account.error');


    }

    public function update_pending(Request $request)
    {   
        // dd($request->all());
        if($request->_token == csrf_token()){
            DB::table('web')->where('id',$request->id)->update([
                'active' => $request->id_pending,
            ]);
            return response()->json([
                'thongbao' => 'ban da phe duyet thanh cong',
            ]);
        }
    }

    public function update_pending_blogs(Request $request)
    {   
        // dd($request->all());
        if($request->_token == csrf_token()){
            DB::table('blogs')->where('id',$request->id)->update([
                'active' => $request->id_pending,
            ]);
            return response()->json([
                'thongbao' => 'ban da phe duyet thanh cong',
            ]);
        }
    }

    public function update_pending_services(Request $request)
    {   
        // dd($request->all());
        if($request->_token == csrf_token()){
            DB::table('service')->where('id',$request->id)->update([
                'active' => $request->id_pending,
            ]);
            return response()->json([
                'thongbao' => 'ban da phe duyet thanh cong',
            ]);
        }
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
        $web = DB::table('web')->where('id',$id)->get();
        if (Gate::allows('add',$web)) {
            $data['web'] = DB::table('web')->find($id);
            if (Gate::allows('edit', $data)) {
                $data['cate_web'] = DB::table('cate_web')->get();
                return view('admins.pages.webstore.edit', $data);
            } else {
                return view('admins.page.account.error');
            }
        } else {
            return view('admins.page.account.error');
        }


    }

    public function editCate($id)
    {

        if (Gate::allows('add')) {
            $data['cate'] = DB::table('cate_web')->find($id);
            $data['cate_web'] = DB::table('cate_web')->get();
            if (Gate::allows('edit', $data)) {

                return view('admins.pages.webstore.editCate', $data);
            } else {
                return view('admins.page.account.error');
            }

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

        $image_update = DB::table('web')->where('id', '=', $id)->pluck('image');

        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $this->validate($request,
            [

                'name' => 'required|min:3',
                'link' => 'required|regex:' . $regex,
            ],
            [
                'name.required' => 'Tên ít nhất 3 kí tự',
            ]);
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $name = $file->getClientOriginalName();
            $image = str_random(4) . "_image_" . $name;
            while (file_exists('assets/img_webs/' . $image)) {
                $image = str_random(4) . "_image_" . $name;
            }
            $file->move('assets/img_webs/', $image);
            $file_name = $image;
            if (file_exists('assets/img_webs/' . $image_update[0]) && $image_update[0] != '') {
                unlink('assets/img_webs/' . $image_update[0]);
            }


        } else {
            $file_name = DB::table('web')->where('id', '=', $id)->pluck('image')->first();

        }

        DB::table('web')->where('id', '=', $id)->update([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'image' => $file_name,
            'link' => $request->link,
            'cate_id' => $request->cate_web,
            'active' => $request->active,
            'created_at' => now(),
        ]);


        return redirect()->route('webstore.index')->with('thongbao', 'Add Success');
    }

    public function updateCate(Request $request, $id)
    {

        $icon_update = DB::table('cate_web')->where('id', '=', $id)->pluck('icon');

        $this->validate($request,
            [

                'name' => 'required|min:3',
            ],
            [
                'name.required' => 'Tên ít nhất 3 kí tự',
            ]);
        if ($request->hasFile('icon')) {

            $file = $request->file('icon');

            $name = $file->getClientOriginalName();
            $icon = str_random(4) . "_icon_" . $name;
            while (file_exists('assets/img_icon/' . $icon)) {
                $icon = str_random(4) . "_icon_" . $name;
            }
            $file->move('assets/img_icon/', $icon);
            $file_name = $icon;
            if (file_exists('assets/img_icon/' . $icon_update[0]) && $icon_update[0] != '') {
                unlink('assets/img_icon/' . $icon_update[0]);
            }


        } else {
            $file_name = DB::table('cate_web')->where('id', '=', $id)->pluck('icon')->first();

        }

        DB::table('cate_web')->where('id',$id)->update([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'icon' => $file_name,
            'active' => $request->active,
            'created_at' => now(),
        ]);


        return redirect()->route('webstore.storeCate')->with('thongbao', 'Add Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $web = DB::table('web')->find($id);

        if(Gate::allows('delete',$web))
        {
            $image_update = DB::table('web')->where('id', '=', $id)->pluck('image');
            if (file_exists('assets/img_webs/' . $image_update[0]) && $image_update[0] != '') {
                unlink('assets/img_webs/' . $image_update[0]);
            }
            DB::table('web')->where('id', '=', $id)->delete();

            return redirect()->route('webstore.index')->with('thongbao', 'Xóa thành công!');
        }
        else return view('admins.page.account.error');

    }

    public function destroyCate($id)
    {
        if (Gate::allows('delete')) {
            $image_update = DB::table('cate_web')->where('id', '=', $id)->pluck('icon');
            if (file_exists('assets/img_icon/' . $image_update[0]) && $image_update[0] != '') {
                unlink('assets/img_icon/' . $image_update[0]);
            }

            DB::table('cate_web')->where('id', '=', $id)->delete();

            return redirect()->back()->with('thongbao', 'Xóa thành công!');

        } else {
            return view('admins.page.account.error');
        }

    }

    public function setactive($id, $status)
    {

        if (Gate::allows('hide'))
        {
            DB::table('web')->where('id', '=', $id)->update([
                'active' => $status,
            ]);
            return redirect()->back()->with('thongbao','Thành công');
        }
        else return view('admins.page.account.error');

    }

    public function setactiveCate($id, $status)
    {
        if (Gate::allows('hide')) {
            DB::table('cate_web')->where('id', '=', $id)->update([
                'active' => $status,
            ]);
            return redirect()->back()->with('thanhcong', 'Thành công');
        } else {
            return view('admins.page.account.error');
        }

    }
}
