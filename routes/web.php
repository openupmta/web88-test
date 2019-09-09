<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index')->name('home');
Route::get('kho-giao-dien', 'FrontendController@khoGiaoDien')->name('kho.giao.dien');
Route::get('kho-giao-dien/{slug}-{id}', 'FrontendController@getListProduct')->name('get.list.product');
Route::get('dich-vu/{slug}', 'FrontendController@getListService')->name('get.list.service');
Route::get('lien-he', 'FrontendController@lienHe')->name('lien.he');
//Route::get('lien-he/{slug}-{id}','FrontendController@getListProduct');
Route::get('khach-hang', 'FrontendController@khachHang')->name('khach.hang');
Route::get('service/{slug}', 'FrontendController@getListOtherService')->name('get.list.other.service');
Route::get('tin-tuc', 'FrontendController@tinTuc')->name('tin.tuc');
Route::get('tin-tuc/{slug}', 'FrontendController@getListNews')->name('get.list.news');
Route::get('thiet-ke-website', 'FrontendController@thietKeWebsite')->name('thiet.ke.website');
Route::get('seo', 'FrontendController@seo')->name('seo');

Route::get('bang-gia-thiet-ke-website', 'FrontendController@bangGiaThietKeWebsite')->name('bang.gia.thiet.ke.website');
Route::get('cham-soc-website', 'FrontendController@chamSocWebsite')->name('cham.soc.website');
Route::get('dich-vu-thiet-ke-website', 'FrontendController@dichVuThietKeWebsite')->name('dich.vu.thiet.ke.website');
Route::get('dich-vu-seo-website', 'FrontendController@dichVuSeoWebsite')->name('dich.vu.seo.website');
Route::get('dich-vu-viet-bai-chuan-seo', 'FrontendController@dichVuVietBaiChuanSeo')->name('dich.vu.viet.bai.chuan.seo');
Route::get('dieu-kien-va-chinh-sach', 'FrontendController@dieuKienVaChinhSach')->name('dieu.kien.va.chinh.sach');
Route::get('domain-gia-re', 'FrontendController@domaiGiaRe')->name('domain.gia.re');

Route::get('hinh-thuc-thanh-toan', 'FrontendController@hinhThucThanhToan')->name('hinh.thuc.thanh.toan');
Route::get('hosting-chat-luong-cao', 'FrontendController@hostingChatLuongCao')->name('hosting.chat.luong.cao');
Route::get('ho-tro-khach-hang', 'FrontendController@hoTroKhachHang')->name('ho.tro.khach.hang');
Route::get('quy-trinh-thiet-ke-website', 'FrontendController@quyTrinhThietKeWebsite')->name('quy.trinh.thiet.ke.website');
Route::get('thiet-ke-web-chuan-moblie', 'FrontendController@thietKeWebChuanMobile')->name('thiet.ke.web.chuan.mobile');
Route::get('thiet-ke-web-chuan-seo-chuyen-nghiep', 'FrontendController@thietKeWebChuanSeoChuyenNghiep')->name('thiet.ke.web.chuan.seo.chuyen.nghiep');
Route::get('thiet-ke-website', 'FrontendController@thietKeWebsite')->name('thiet.ke.website');
Route::get('thiet-ke-website-theo-mau', 'FrontendController@thietKeWebsiteTheoMau')->name('thiet.ke.website.theo.mau');
Route::get('thiet-ke-web-tron-goi-gia-re', 'FrontendController@thietKeWebTronGoiGiaRe')->name('thiet.web.tron.goi.gia.re');
Route::get('tin-tuc', 'FrontendController@tinTuc')->name('tin.tuc');
Route::get('tuyen-dung', 'FrontendController@tuyenDung')->name('tuyen.dung');
Route::get('thiet-ke-web-theo-yeu-cau', 'FrontendController@thietKeWebTheoYeuCau')->name('thiet.ke.web.theo.yeu.cau');
Route::get('dich-vu-thiet-ke-web-gia-re', 'FrontendController@dichVuThietKeWebGiaRe')->name('dich.vu.thiet.ke.web.gia.re');
Route::post('dang-ky', 'FrontendController@dangki')->name('khoi.tao.web');
Auth::routes();
Route::group(['prefix' => 'admin'], function () {
    /*
     * Admin đăng nhập
     */
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.showLoginForm');
    Route::post('login', 'Auth\LoginController@postLogin')->name('admin.login_post');
    /*
     * Admin đăng xuất
     */
    Route::get('logout', 'Auth\LogoutController@logout')->name('admin.logout');
});
Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdmin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/dashboard', 'AdminController@index');
    /*
     * Tài khoản
     */
    Route::prefix('account')->group(function () {

        Route::group(['prefix' => 'editor'],function(){
            Route::get('profile','AccountController@profile')->name('editor.account.profile');
            Route::post('add','AccountController@store')->name('editor.account.store');
            Route::get('edit/{id}','AccountController@edit')->name('editor.account.edit');
            Route::post('update/{id}','AccountController@update')->name('editor.account.update');
            Route::get('delete/{id}','AccountController@delete')->name('editor.account.delete');

            Route::post('update_pending','WebStoreController@update_pending')->name('update_pending');
            Route::post('update_pending_blogs','WebStoreController@update_pending_blogs')->name('update_pending_blogs');
            Route::post('update_pending_services','WebStoreController@update_pending_services')->name('update_pending_services');
        });
        Route::group(['prefix' => 'user'], function () {
            Route::get('profile', 'ClientController@profile')->name('editor.account.index');
            Route::post('add', 'ClientController@store')->name('user.account.store');
            Route::get('edit/{id}', 'ClientController@edit')->name('user.account.edit');
            Route::post('edit/{id}', 'ClientController@update')->name('user.account.update');
            Route::get('delete/{id}', 'ClientController@delete')->name('user.account.delete');
        });
        Route::group(['prefix' => 'pending'], function () {
            Route::get('index', 'PendingController@index')->name('pending.index');
        });
    });
    
    Route::prefix('web_users')->group(function(){

        Route::get('list','WebUsersController@list')->name('web_users.contact');
        Route::post('add','WebUsersController@add')->name('web_users.add');
        Route::post('edit_pending','WebUsersController@edit_pending')->name('edit_pending');
        Route::get('detail/{web_id}/{users_id}','WebUsersController@detail')->name('detail');
    });

    Route::prefix('partner')->group(function(){
        Route::get('list','PartnerController@list')->name('partner.list');
        Route::get('add','PartnerController@add')->name('partner.add');
        Route::post('add','PartnerController@store')->name('partner.add');
        Route::get('edit/{id}','PartnerController@edit')->name('partner.edit');
        Route::post('edit/{id}','PartnerController@update')->name('partner.edit');
        Route::get('delete/{id}','PartnerController@delete')->name('partner.delete');
    });

    Route::prefix('contact')->group(function(){
        Route::get('list','ContactController@list')->name('contact.list');
        Route::get('add','ContactController@add')->name('contact.add');
        Route::post('add','ContactController@store')->name('contact.add');
        Route::get('edit/{id}','ContactController@edit')->name('contact.edit');
        Route::post('edit/{id}','ContactController@update')->name('contact.edit');
        Route::get('delete/{id}','ContactController@delete')->name('contact.delete');
    });

    Route::prefix('supports')->group(function(){
        Route::get('list','SupportsController@list')->name('supports.list');
        Route::get('add','SupportsController@add')->name('supports.add');
        Route::post('add','SupportsController@store')->name('supports.add');
        Route::get('edit/{id}','SupportsController@edit')->name('supports.edit');
        Route::post('edit/{id}','SupportsController@update')->name('supports.edit');
        Route::get('delete/{id}','SupportsController@delete')->name('supports.delete');
    });
    Route::prefix('blogs')->group(function () {
        Route::get('/list', 'BlogsController@index')->name('blogs.index');
        Route::get('/add', 'BlogsController@create')->name('blogs.create');
        Route::post('/add', 'BlogsController@store')->name('blogs.store');
        Route::get('/add-cate', 'BlogsController@createCate')->name('blogs.createCate');
        Route::post('/add-cate', 'BlogsController@storeCate')->name('blogs.storeCate');
        Route::get('/edit/{id}', 'BlogsController@edit')->name('blogs.edit');
        Route::post('/edit/{id}', 'BlogsController@update')->name('blogs.update');
        Route::get('/destroy/{id}', 'BlogsController@destroy')->name('blogs.destroy');
        Route::get('/destroy-cate/{id}', 'BlogsController@destroyCate')->name('blogs.destroyCate');
        Route::get('/show/{id}', 'BlogsController@show')->name('blogs.show');
        Route::get('/detail/{id}', 'BlogsController@detail')->name('blogs.detail');
        Route::get('/setactive/{id}/{status}', 'BlogsController@setactive')->name('blogs.setactive');
        Route::get('/setactive-cate/{id}/{status}', 'BlogsController@setactiveCate')->name('blogs.setactiveCate');
    });
    //    News
    Route::prefix('web-store')->group(function () {
        Route::get('/list', 'WebStoreController@index')->name('webstore.index');
        Route::get('/add', 'WebStoreController@create')->name('webstore.create');
        Route::post('/add', 'WebStoreController@store')->name('webstore.store');
        Route::get('/add-cate', 'WebStoreController@createCate')->name('webstore.createCate');
        Route::post('/add-cate', 'WebStoreController@storeCate')->name('webstore.storeCate');
        Route::get('/edit/{id}', 'WebStoreController@edit')->name('webstore.edit');
        Route::post('/edit/{id}', 'WebStoreController@update')->name('webstore.update');

        Route::get('/edit-cate/{id}', 'WebStoreController@editCate')->name('webstore.editCate');
        Route::post('/edit-cate/{id}', 'WebStoreController@updateCate')->name('webstore.updateCate');

        Route::get('/destroy/{id}', 'WebStoreController@destroy')->name('webstore.destroy');
        Route::get('/destroy-cate/{id}', 'WebStoreController@destroyCate')->name('webstore.destroyCate');
        Route::get('/show/{id}', 'WebStoreController@show')->name('webstore.show');
        Route::get('/detail/{id}', 'WebStoreController@detail')->name('webstore.detail');
        Route::get('/setactive/{id}/{status}', 'WebStoreController@setactive')->name('webstore.setactive');
        Route::get('/setactive-cate/{id}/{status}', 'WebStoreController@setactiveCate')->name('webstore.setactiveCate');
    });
//    Service
    Route::prefix('service')->group(function () {
        Route::get('/list', 'ServiceController@index')->name('service.index');
        Route::get('/add', 'ServiceController@create')->name('service.create');
        Route::post('/add', 'ServiceController@store')->name('service.store');
        Route::get('/add-cate', 'ServiceController@createCate')->name('service.createCate');
        Route::post('/add-cate', 'ServiceController@storeCate')->name('service.storeCate');
        Route::get('/edit/{id}', 'ServiceController@edit')->name('service.edit');
        Route::post('/edit/{id}', 'ServiceController@update')->name('service.update');
        Route::get('/destroy/{id}', 'ServiceController@destroy')->name('service.destroy');
        Route::get('/destroy-cate/{id}', 'ServiceController@destroyCate')->name('service.destroyCate');
        Route::get('/show/{id}', 'ServiceController@show')->name('service.show');
        Route::get('/detail/{id}', 'ServiceController@detail')->name('service.detail');
        Route::get('/setactive/{id}/{status}', 'ServiceController@setactive')->name('service.setactive');
        Route::get('/setactive-cate/{id}/{status}', 'ServiceController@setactiveCate')->name('service.setactiveCate');
    });
//    Other Service
    Route::prefix('other-service')->group(function () {
        Route::get('/list', 'OtherServiceController@index')->name('other_service.index');
        Route::get('/add', 'OtherServiceController@create')->name('other_service.create');
        Route::post('/add', 'OtherServiceController@store')->name('other_service.store');
//        Route::get('/add-cate', 'OtherServiceController@createCate')->name('other_service.createCate');
//        Route::post('/add-cate', 'OtherServiceController@storeCate')->name('other_service.storeCate');
        Route::get('/edit/{id}', 'OtherServiceController@edit')->name('other_service.edit');
        Route::post('/edit/{id}', 'OtherServiceController@update')->name('other_service.update');
        Route::get('/destroy/{id}', 'OtherServiceController@destroy')->name('other_service.destroy');
        Route::get('/destroy-cate/{id}', 'OtherServiceController@destroyCate')->name('other_service.destroyCate');
        Route::get('/show/{id}', 'OtherServiceController@show')->name('other_service.show');
        Route::get('/detail/{id}', 'OtherServiceController@detail')->name('other_service.detail');
        Route::get('/setactive/{id}/{status}', 'OtherServiceController@setactive')->name('other_service.setactive');
        Route::get('/setactive-cate/{id}/{status}', 'OtherServiceController@setactiveCate')->name('other_service.setactiveCate');
    });
//    Slider
    Route::prefix('slider')->group(function () {
        Route::get('/list', 'SliderController@index')->name('slider.index');
        Route::get('/add', 'SliderController@create')->name('slider.create');
        Route::post('/add', 'SliderController@store')->name('slider.store');
        Route::get('/edit/{id}', 'SliderController@edit')->name('slider.edit');
        Route::post('/edit/{id}', 'SliderController@update')->name('slider.update');
        Route::get('/destroy/{id}', 'SliderController@destroy')->name('slider.destroy');
        Route::get('/show/{id}', 'SliderController@show')->name('slider.show');
        Route::get('/detail/{id}', 'SliderController@detail')->name('slider.detail');
        Route::get('/setactive/{id}/{status}', 'SliderController@setactive')->name('slider.setactive');
    });
//    Slider content
    Route::prefix('slider-content')->group(function () {
        Route::get('/list', 'SliderContentController@index')->name('slidercontent.index');
        Route::get('/add', 'SliderContentController@create')->name('slidercontent.create');
        Route::post('/add', 'SliderContentController@store')->name('slidercontent.store');
        Route::get('/edit/{id}', 'SliderContentController@edit')->name('slidercontent.edit');
        Route::post('/edit/{id}', 'SliderContentController@update')->name('slidercontent.update');
        Route::get('/destroy/{id}', 'SliderContentController@destroy')->name('slidercontent.destroy');
        Route::get('/show/{id}', 'SliderContentController@show')->name('slidercontent.show');
        Route::get('/detail/{id}', 'SliderContentController@detail')->name('slidercontent.detail');
        Route::get('/setactive/{id}/{status}', 'SliderContentController@setactive')->name('slidercontent.setactive');
    });
});



