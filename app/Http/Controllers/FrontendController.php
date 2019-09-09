<?php
namespace App\Http\Controllers;
use App\Blogs;
use App\CateWeb;
use App\OtherService;
use App\Partner;
use App\Service;
use App\Web;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
class FrontendController extends Controller
{
    public function __construct()
    {
        $cateweb = CateWeb::all();
        View::Share('cateweb', $cateweb);
        $supports = DB::table('supports')->get();
        View::Share('supports', $supports);
        $contact = DB::table('contact')->first();
        View::Share('contact', $contact);
        $servis = Service::where('active', Service::STATUS_PUBLIC)->get();
        View::Share('servis', $servis);
        $serviHot = Service::where([['footer_hot',1],['active',Service::STATUS_PUBLIC]])->limit(5)->get();
        View::Share('serviHot', $serviHot);
        $otherservi = OtherService::where('active', OtherService::STATUS_PUBLIC)->get();
        View::Share('otherservi',$otherservi);
        $otherHot = OtherService::where([['footer_hot',1],['active',OtherService::STATUS_PUBLIC]])->limit(5)->get();
        View::Share('otherHot',$otherHot);
        $news = Blogs::where('active', Blogs::STATUS_PUBLIC)->get();
        View::Share('news',$news);
        $newHot = Blogs::where([['footer_hot',1],['active',Blogs::STATUS_PUBLIC]])->limit(5)->get();
        View::Share('newHot',$newHot);
    }
    public function khoGiaoDien(Request $request)
    {
        $webs = Web::where([
            'active' => Web::STATUS_PUBLIC
        ]);
        if ($request->name != null) {
            $webs->where('name', 'like', '%' . $request->name . '%');
        }
        $viewData = [
            'webs' => $webs->paginate(18),
        ];
//        dd($viewData);
        return view('pages.khogiaodien', $viewData);
    }
    public function getListProduct(Request $request)
    {
        $url = $request->segment(2);
        $url = preg_split('/(-)/i', $url);
        if ($id = array_pop($url)) {
            $products = Web::where([
                'cate_id' => $id,
                'active' => Web::STATUS_PUBLIC
            ]);
            if ($request->name != null) {
                $products->where('name', 'like', '%' . $request->name . '%');
            }
            $viewData = [
                'products' => $products->orderBy('id', 'DESC')->paginate(10)
            ];
            return view('pages.product.index', $viewData);
        }
        return redirect('/');
    }
    public function dangki(Request $request)
    {
        $this->validate($request, [
            'w_name' => 'required|min:3',
            'w_email' => 'required|unique:users,email',
            'w_address' => 'required',
            'w_phone' => 'required',
        ],
            [
                'w_name.required' => 'Tên không được để trống.',
                'w_name.min' => 'Tên phải ít nhất 3 ký tự.',
                'w_email.required' => 'Email không được để trống.',
                'w_email.unique' => 'Email đã tồn tại trong cơ sở dữ liệu.',
                'w_address.required' => 'Địa chỉ không được để trống.',
                'w_phone.required' => 'Số điện thoại không được để trống.',
            ]);
        $id = DB::table('users')->insertGetId(
            [
                'name' => $request->w_name,
                'address' => $request->w_address,
                'email' => $request->w_email,
                'phone' => $request->w_phone,
                'created_at' => now(),
            ]
        );

        if (isset($request->w_id)) {
            DB::table('web_users')->insert([
                'title' => $request->w_title,
                'content' => $request->w_content,
                'web_id' => $request->w_id,
                'users_id' => $id,
                'created_at' => now(),
            ]);

            return redirect()->back()->with('thongbao', 'Khởi tạo website thành công.');
        }

        return redirect()->back()->with('thongbao', 'Tạo liên hệ thành công.');
    }
    public function lienHe(Request $request)
    {
        $webs = Web::where([
            'active' => Web::STATUS_PUBLIC
        ]);
        if ($request->name != null) {
            $webs->where('name', 'like', '%' . $request->name . '%');
        }
        $viewData = [
            'webs' => $webs->paginate(18),
        ];

        return view('pages.lienhe', $viewData);
    }
    public function getListService(Request $request)
    {
        if(!$request->session()->has($request->slug))
        {
            DB::table('service')->where('slug',$request->slug)->increment('view',1);
        }
        $url = $request->segment(2);
        $services = Service::where([
            'slug' => $url,
            'active' => Service::STATUS_PUBLIC
        ])->first();
        $sliders = DB::table('slider_content')->where('active', 1)->get();
        $viewData = [
            'services' => $services,
            'sliders' => $sliders
        ];
        return view('pages.dichvu', $viewData);
    }
    public function getListOtherService(Request $request)
    {
        if(!$request->session()->has($request->slug))
        {
            DB::table('other_service')->where('slug',$request->slug)->increment('view',1);
        }
        $url = $request->segment(2);
        $otherService = OtherService::where([
            'slug' => $url,
            'active' => OtherService::STATUS_PUBLIC
        ])->first();
        $viewData = [
            'otherService' => $otherService
        ];
        return view('pages.dichvukhac', $viewData);
    }
    public function getListNews(Request $request)
    {
        $newsHots = Blogs::select('name','view','slug')->orderBy('view','DESC')->where('active',1)->limit(10)->get();
        // if(!$request->session()->has($request->slug))
        // {
        //     DB::table('new')->where('slug',$request->slug)->increment('view',1);
        // }
        $url = $request->segment(2);
        $listNews = Blogs::where([
            'slug' => $url,
            'active' => Blogs::STATUS_PUBLIC
        ])->first();
        $viewData = [
            'listNews' => $listNews,
            'newsHots' => $newsHots,
        ];
        return view('pages.chitiettin',$viewData);
    }
    public function tinTuc()
    {
        $newsHots = Blogs::select('name','view','slug')->orderBy('view','DESC')->where('active',1)->limit(10)->get();
        return view('pages.tintuc',compact('newsHots'));
    }
    public function khachHang()
    {
        $partners = Partner::all();
        return view('pages.khachhang', compact('partners'));
    }
    public function seo()
    {
        $seo = Blogs::where([['cate_id',1],['active',1]])->paginate(10);
        $newsHot = Blogs::select('name','view','slug')->orderBy('view','DESC')->where([['cate_id',1],['active',1]])->limit(12)->get();
        $viewData = [
            'seo' => $seo,
            'newsHot' => $newsHot,
        ];
        return view('pages.seo',$viewData);
    }
    public function thietKeWebsite()
    {
        $tkweb = Blogs::where([['cate_id',2],['active',1]])->paginate(10);
        $newsHot = Blogs::select('name','view','slug')->orderBy('view','DESC')->where([['cate_id',2],['active',1]])->limit(12)->get();
        $viewData = [
            'tkweb' => $tkweb,
            'newsHot' => $newsHot,
        ];
        return view('pages.thietke-website',$viewData);
    }
    public function bangGiaThietKeWebsite()
    {
        return view('pages.banggiathietkewebsite');
    }
    public function chamSocWebsite()
    {
        return view('pages.chamsocwebsite');
    }
    public function dichVuThietKeWebsite()
    {
        return view('pages.dichvu-thietkewebgiare');
    }
    public function dichVuSeoWebsite()
    {
        return view('pages.dichvuseowebsite');
    }
    public function dichVuVietBaiChuanSeo()
    {
        return view('pages.dichvuvietbaichuanseo');
    }
    public function dieuKienVaChinhSach()
    {
        return view('pages.dieukienvachinhsach');
    }
    public function domaiGiaRe()
    {
        return view('pages.domaingiare');
    }
    public function hinhThucThanhToan()
    {
        return view('pages.hinhthucthanhtoan');
    }
    public function hostingChatLuongCao()
    {
        return view('pages.hostingchatluongcao');
    }
    public function hoTroKhachHang()
    {
        return view('pages.hotrokhachhang');
    }
    public function quyTrinhThietKeWebsite()
    {
        return view('pages.quuytrinhthietkewebsite');
    }
    public function thietKeWebChuanMobile()
    {
        return view('pages.thietkewebchuanmoblie');
    }
    public function thietKeWebChuanSeoChuyenNghiep()
    {
        return view('pages.thietkewebchuanseochuyennghiep');
    }
    public function thietKeWebsiteTheoMau()
    {
        return view('pages.thietkewebsitetheomau');
    }
    public function thietKeWebTronGoiGiaRe()
    {
        return view('pages.thietkewebtrongoigiare');
    }
    public function tuyenDung()
    {
        return view('pages.tuyendung');
    }
}