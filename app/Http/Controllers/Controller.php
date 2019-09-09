<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $data['web_count'] = DB::table('web')->count();
        $data['cate_web_count'] = DB::table('cate_web')->count();
        $data['blogs_count'] = DB::table('blogs')->count();
        $data['cate_blogs_count'] = DB::table('cate_blogs')->count();
        $data['service_count'] = DB::table('service')->count();
//        $data['cate_service_count'] = DB::table('cate_service')->count();
        $data['other_service_count'] = DB::table('other_service')->count();
        $data['slider_count'] = DB::table('sliders')->count();
        $data['slidercontent_count'] = DB::table('slider_content')->count();
//        $data['cate_other_service_count'] = DB::table('cate_other_service')->count();
        view()->share($data);
    }
}
