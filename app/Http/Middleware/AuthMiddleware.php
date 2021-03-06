<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Encryption\Encrypter;
use Redirect;
use URL;
use Input;
use JerryLib\User\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 如果访问权限不在白名单中就验证权限
        // 这里加上参数做个判断
        $url = trim(Request::getRequestUri(), '/');
        if($len = strpos($url, '?')) {
            $naction = substr($url, 0, strpos($url, '?'));    
        } else {
            $naction = $url;
        }
        list($module, $controller, $action) = explode('/', $naction);
        if(!stristr(NOT_AUTH_MODULE, $module.'/'.$controller)) {
            // 判断用户是否登录，如果没登登录的话跳转到登录页面
            if(!Session::has('_AUTH_USER_ISLOGIN') && !Session::get('_AUTH_USER_ISLOGIN')===true) {
                return Redirect::to('Admin/Index/login');
            }

            // 判断当前操作是否具有权限
            if(!strpos($naction, '/')) {
                $naction = $naction . '/Index/index';
            }
            if(!stristr($action, NOT_AUTH_ACTION)) {
                $ruleName = $module.'/'.$controller.'/'.$action;
                if(!Auth::checkrule($ruleName, Session::get('_AUTH_USER_UID'), 1, Session::get('_AUTH_USER_ISADMIN'))) {
                    return '对不起，您没有权限!';
                }
            }
        }


//        $session_id = Session::getId();
//        Session::put(['_AUTH_ISLOGIN'=>true]);
//        echo trim(Request::getRequestUri(), '/');


        return $next($request);
    }
}
