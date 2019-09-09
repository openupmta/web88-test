<?php

namespace App\Http\Controllers;

use App\CateWeb;
use App\Partner;
use App\Web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $webs = Web::where([
            'active' => Web::STATUS_PUBLIC
        ]);

        $catewebs = CateWeb::where([
            'active' => CateWeb::STATUS_PUBLIC
        ])->limit(8)->get();

        $partners = Partner::where('active',CateWeb::STATUS_PUBLIC)->limit(12)->get();

        $sliders = DB::table('sliders')->where('active',1)->get();

        $viewData = [
            'webs' => $webs->paginate(18),
            'catewebs' => $catewebs,
            'partners' => $partners,
            'sliders' => $sliders,
        ];
        return view('index',$viewData);
    }


}
