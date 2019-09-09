<?php

namespace App\Providers;

use function foo\func;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //Admin
        //1:Quản trị
        // 2:Editor
        // 3:User
        $role=['1','2','3'];

        Gate::before(function($user) {
            if($user->level == '1') {
                return true;
                }
        });

        Gate::define('view',function($user){
            return $user->level==1;
        });

        // Editor: quyền thêm web, service, blog
        Gate::define('add',function($user){
            return $user->level==2;
        });

        //User: quyền sửa khi ở trạng thái pending=0

        Gate::define('edit',function($user,$web){
            if($user->level==3){
                if($web->active==0){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return true;
            }
        });
        //User: quyền xóa khi ở trạng thái pending=0
        Gate::define('delete',function($user,$web){
            if($user->level==3){
                if($web->active==0){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return true;
            }
        });
        Gate::define('hide',function ($user){
            if($user->level == 3) return false;
            else return true;
        });


    }
}
