<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WarehouseWebController extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Kho giao diện
         */
        Schema::create('cate_web', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->tinyInteger('active')->default(1)->index();
            $table->string('slug')->index();
            $table->char('icon')->nullable();
            $table->timestamps();
        });
        Schema::create('web', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->index();
            $table->string('image');
            $table->string('link');

            $table->bigInteger('cate_id')->unsigned();
            $table->foreign('cate_id')
                ->references('id')
                ->on('cate_web')
                ->onDelete('cascade');
            $table->tinyInteger('active')->default(1)->index();
            $table->timestamps();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('phone');
            $table->timestamps();
        });
        Schema::create('web_users', function (Blueprint $table) {
            $table->bigInteger('users_id')->unsigned();
            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->bigInteger('web_id')->unsigned();
            $table->foreign('web_id')
                ->references('id')
                ->on('web')
                ->onDelete('cascade');
            $table->tinyInteger('status')->default(0);
            
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->timestamps();
        });
    /**
     * Dịch vụ - Thiết kế - Seo
     */
//        Schema::create('cate_service', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->string('name');
//            $table->string('slug');
//            $table->tinyInteger('active');
//            $table->timestamps();
//        });

        Schema::create('service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('image');
            $table->text('summary');
            $table->text('content');
            $table->integer('view')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->tinyInteger('footer_hot')->default(0);
//            $table->bigInteger('cate_id')->unsigned();
//            $table->foreign('cate_id')
//                ->references('id')
//                ->on('cate_service')
//                ->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('service_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')
                ->references('id')
                ->on('service')
                ->onDelete('cascade');
            $table->timestamps();
            $table->integer('searchs');
        });


        /**
         * Đối tác
         */
        Schema::create('partner', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('logo');
            $table->string('link')->nullable();
            $table->tinyInteger('active');
            $table->timestamps();
        });
        /**
         * Admin
         */
        Schema::create('role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });
        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone');
            $table->bigInteger('level')->unsigned();
            $table
                ->foreign('level')
                ->references('id')
                ->on('role')
                ->onDelete('cascade');
            $table->integer('status');
            $table->timestamps();

        });
        //Slider
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image');
            $table->string('title')->nullable();
            $table->tinyInteger('active')->default(0);
            $table->timestamps();
        });
        Schema::create('slider_content', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image');
            $table->string('title')->nullable();
            $table->tinyInteger('active')->default(0);
            $table->timestamps();
        });
        //Support
        Schema::create('supports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image');
            $table->string('phone');
            $table->string('email')->unique();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
        });
        //Contact
        Schema::create('contact', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('masothue');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('website');
            $table->tinyInteger('active');
            $table->timestamps();
        });
        //Blogs
        Schema::create('cate_blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('active');
            $table->timestamps();
        });
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('image');
            $table->text('summary');
            $table->text('detail');
            $table->tinyInteger('active')->default(0);
            $table->integer('view')->default(0);
            $table->tinyInteger('footer_hot')->default(0);
            $table->bigInteger('cate_id')->unsigned();
            $table->foreign('cate_id')
                ->references('id')
                ->on('cate_blogs')
                ->onDelete('cascade');
            $table->bigInteger('admin_id')->unsigned();
            $table->foreign('admin_id')
                ->references('id')
                ->on('admin')
                ->onDelete('cascade');
            $table->timestamps();


        });
        Schema::create('blog_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('blogs_id')->unsigned();
            $table->foreign('blogs_id')
                ->references('id')
                ->on('blogs')
                ->onDelete('cascade');
            $table->timestamps();
            $table->integer('searchs');
        });


        Schema::create('other_service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('image');
            $table->text('summary');
            $table->text('content');
            $table->tinyInteger('footer_hot')->default(0);
            $table->integer('view')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->timestamps();

        });
        Schema::create('other_service_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('other_service_id')->unsigned();
            $table->foreign('other_service_id')
                ->references('id')
                ->on('other_service')
                ->onDelete('cascade');
            $table->timestamps();
            $table->integer('searchs');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
