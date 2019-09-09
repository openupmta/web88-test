<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call($this->role());
        $this->call($this->admin());
    }
    private function role()
    {
//        $location = "Cộng tác viên, Quản trị viên, Người dùng";
//        $explode = explode(',',$location);
        //        $location = "Cộng tác viên, Quản trị viên, Người dùng";
        //        $explode = explode(',',$location);
        $location =array('Quản trị viên','Cộng tác viên','Người dùng');
        for ($i = 0; $i <= 2; $i++ )
        {
            DB::table('role')->insert([
                'id' => $i+1,
                'name' => $location[$i],
            ]);
        }

        DB::table('cate_web')->insert([
            [
                'name' => 'Mẫu web thương mại điện tử',
                'slug' => 'mau-web-thuong-mai-dien-tu',
                'icon' => 'cart.png'
            ],
            [
                'name' => 'Mẫu web giới thiệu công ty',
                'slug' => 'mau-website-gioi-thieu-cong-ty',
                'icon' => 'intro-web.png'
            ],
            [
                'name' => 'Mẫu web tin tức',
                'slug' => 'mau-web-tin-tuc',
                'icon' => 'news.png'
            ],
            [
                'name' => 'Mẫu web âm nhạc',
                'slug' => 'mau-web-am-nhac',
                'icon' => 'music.png'
            ],
            [
                'name' => 'Mẫu web ảnh viện áo cưới',
                'slug' => 'mau-web-anh-vien-ao-cuoi',
                'icon' => 'heart.png'
            ],
            [
                'name' => 'Mẫu web bất động sản',
                'slug' => 'mau-web-bat-dong-san',
                'icon' => 'real-estate.png'
            ],
            [
                'name' => 'Mẫu web giáo dục',
                'slug' => 'mau-web-giao-duc',
                'icon' => 'education.png'
            ],
            [
                'name' => 'Mẫu web cá nhân',
                'slug' => 'mau-web-ca-nhan',
                'icon' => 'personal.png'
            ],
        ]);

        DB::table('web')->insert([
            [
                'name' => 'Mẫu web bán hàng home Shop chuyên nghiệp giá rẻ',
                'slug' => 'mau-web-ban-hang-home-shop-chuyen-nghiep-gia-re',
                'image'=> 'httphaithu.com.png',
                'link'=> 'http://haithu.com/',
                'cate_id'=> '1',
            ],
            [
                'name' => 'Thiết kế website bán hàng quần áo',
                'slug' => 'thiet-ke-website-ban-hang-quan-ao',
                'image'=> 'lalaland-vu.herokuapp.com.png',
                'link'=> 'http://thoitranglalaland.vn/',
                'cate_id'=> '2',
            ],
            [
                'name' => 'Thiết kế website bán hàng hoa quả',
                'slug' => 'thiet-ke-website-ban-hang-hoa-qua',
                'image'=> 'thucpham.herokuapp.com.png',
                'link'=> 'https://thucpham.herokuapp.com/',
                'cate_id'=> '3',
            ],
            [
                'name' => 'Mẫu web giới thiệu công ty',
                'slug' => 'mau-website-gioi-thieu-cong-ty',
                'image'=> 'ducthangth.com.png',
                'link'=> 'http://ducthangth.com/',
                'cate_id'=> '1',
            ],
        ]);

        DB::table('slider_content')->insert([
            [
                'title' => 'banner1-400x250.jpg',
                'image'=> 'banner1-400x250.jpg',
                'active' => 1,
            ],
            [
                'title' => 'Mẫu web bán hàng home Shop chuyên nghiệp giá rẻ',
                'image'=> 'dich-vu-auto-leech-bai-auto-post-400x250.jpg',
                'active' => 1,
            ],
            [
                'title' => 'Mẫu web bán hàng home Shop chuyên nghiệp giá rẻ',
                'image'=> 'gioi-thieu-dich-vu-thiet-ke-website-400x250.jpg',
                'active' => 1,
            ],
            [
                'title' => 'Mẫu web bán hàng home Shop chuyên nghiệp giá rẻ',
                'image'=> 'heading2-400x250.jpg',
                'active' => 1,
            ],
            [
                'title' => 'Mẫu web bán hàng home Shop chuyên nghiệp giá rẻ',
                'image'=> 'slide1111111111-400x250.jpg',
                'active' => 1,
            ],
            [
                'title' => 'Mẫu web bán hàng home Shop chuyên nghiệp giá rẻ',
                'image'=> 'thiet-ke-website-chuyen-nghiep11-400x250.jpg',
                'active' => 1,
            ],
            [
                'title' => 'Mẫu web bán hàng home Shop chuyên nghiệp giá rẻ',
                'image'=> 'thiet-ke-website-nha-hang-400x250.jpg',
                'active' => 1,
            ],
            [
                'title' => 'Mẫu web bán hàng home Shop chuyên nghiệp giá rẻ',
                'image'=> 'web-doanh-nghiep-400x250.png',
                'active' => 1,
            ]
        ]);
        DB::table('supports')->insert([
            [
                'name' => 'Tư vấn thiết kế web',
                'image' => 'tuvan1.jpg',
                'phone' => '0927 15 15 35',
                'email' => 'sale1@web88.vn',
                'active' => '1'
            ],
            [
                'name' => 'Tư vấn thiết kế web',
                'image' => 'tuvan2.jpg',
                'phone' => '0927 15 15 35',
                'email' => 'sale2@web88.vn',
                'active' => '1'
            ],
            [
                'name' => 'Hỗ trợ kỹ thuật',
                'image' => 'hotrokythuat.jpg',
                'phone' => '0988 747 982',
                'email' => 'htkt@web88.vn',
                'active' => '1'
            ],
            [
                'name' => 'Chăm sóc khách hàng',
                'image' => 'cskh.jpg',
                'phone' => 'contact@talentwins.co',
                'email' => 'cskh@web88.vn',
                'active' => '1'
            ]
        ]);
        DB::table('contact')->insert([
            [
                'title' => 'Công ty Công nghệ và Dịch vụ Talent Wins',
                'masothue' => '0108134425',
                'address' => 'Tòa nhà CT2, khu đô thị Constrexim Thái Hà, Phạm Văn Đồng, Hà Nội',
                'phone' => '0927 15 15 35',
                'email' => 'contact@talentwins.co',
                'website' => 'Talentwins.co',
                'active' => '1'
            ]
        ]);
        DB::table('partner')->insert([
            [
                'name' => 'Viet Phone',
                'logo' => '2-dunkin-donuts1.jpg',
                'link' => '0927 15 15 35',
                'active' => '1'
            ],
            [
                'name' => 'Tâm khoa Shop',
                'logo' => 'anhduong.jpg',
                'link' => 'http://tamkhoashop.com/',
                'active' => '1'
            ],
            [
                'name' => 'Phúc Khang',
                'logo' => 'bangiatot.jpg    ',
                'link' => 'http://phuckhang.vn/',
                'active' => '1'
            ],
            [
                'name' => 'HLC.,JSC',
                'logo' => 'ischool.png',
                'link' => 'http://hlc.com.vn/en/',
                'active' => '1'
            ]
        ]);

    }
    private function admin()
    {

       DB::table('admin')->insert([
           'name' => 'admin',
           'email' => 'admin@gmail.com',
           'password' => bcrypt('123456'),
           'phone' => '0388346413',
           'level' => '1',
           'status' => '0',
       ]);
//
//        DB::table('blogs')->insert([
//            'summary' => 'Conong nghe......',
//            'detail' => 'dasdsdab đ sá ÁHASASA',
//            'image' => 'imgae-1.jpg',
//            'title' => 'dsdadasd dsda',
//            'id_blog'=>1,
//            'active'=>0,
//            'view'=>100,
//            'admin_id'=>'1',
//            'created_at' => now(),
//        ]);


    }
}
