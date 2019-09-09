<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WebUsersController extends Controller
{

    public function list()
    {
        $web_users['web_users']=DB::table('web_users')
                ->join('web','web.id','=','web_users.web_id')
                ->join('users','users.id','=','web_users.users_id')
                ->select('users.name as name_users','web.name as name_web','users.*','web_users.*')
                ->get();
//        dd($web_users);
        return view('admins.page.web_users.list',$web_users);
    }

    public function edit_pending(Request $request)
    {
        //dd($request->all());
        if($request->_token == csrf_token()){
            DB::table('web_users')->where('users_id',$request->users_id)
                                ->where('web_id',$request->web_id)                       
                                ->update([
                                    'status' => $request->id_pending,
                                ]);
            return response()->json([
                'thongbao' => 'ban da phe duyet thanh cong',
            ]);
        }
    }

    public function detail($web_id,$users_id)
    {
        $web_users['web_users']=DB::table('web_users')
                ->join('web','web.id','=','web_users.web_id')
                ->join('users','users.id','=','web_users.users_id')
                ->select('users.name as name_users','web.name as name_web','users.*','web_users.*')
                ->where('web_id',$web_id)
                ->where('users_id',$users_id)
                ->first();
        return view('admins.page.web_users.detail',$web_users);
    }
}
