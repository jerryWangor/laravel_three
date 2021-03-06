<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {

    //    return view('welcome');
    //    return 'hello world';
    //    return response('dsdsdad', 200)->header('Content-Type', 'text/html'); //自定义响应
    //    return response()->view('hello', array('msg' => 'hello World!'))->header('Content-Type', 'text/html')->withCookie(cookie('name', 'value')); //自定义响应到模板
    //    return response()->json(['name'=>'jerry', 'age'=>'23']);
    //    $results = DB::select('select * from user where id = ?', [1]);
    //    echo '<pre>';var_dump($results[0]);

//});

//后台入口地址
Route::get('/', 'Admin\IndexController@getIndex');
// 注册
// Route::get('register', 'Admin\IndexController@getRegister');
//退出登录
Route::any('exit', 'Admin\IndexController@getLogout');
//获取在线人数
Route::post('getOnlineNum', function() {
    $onlineNum = \JerryLib\User\userManage::Init()->getOnlineNum();
    return response()->json(array('ret'=>0, 'num'=>$onlineNum));
});


//登录判断权限组
Route::group(['prefix' => 'Admin', 'middleware' => ['myauth']], function() {

    Route::get('/', 'Admin\IndexController@getIndex');
    Route::controller('Index','Admin\IndexController');
    Route::controller('User','Admin\UserController');
    Route::controller('UserGroup','Admin\UserGroupController');
    Route::controller('Rules','Admin\RulesController');
    Route::controller('Goods','Admin\GoodsController');
    Route::controller('Ajax','Admin\AjaxController');
    Route::controller('Vipinfo','Admin\VipinfoController');
    Route::controller('Shop','Admin\ShopController');
    Route::controller('Order','Admin\OrderController');
    Route::controller('Myorder','Admin\MyorderController');

//    Route::get('User', function () {
//
//    });

//    Route::any('{module}/{controller}/{action}', function($module = 'Admin', $controller = 'index', $action = 'action') {
//        return url($module.'\\'.$controller.'Controller@'.$action);
//    });

});


//`'prefix' => 'admin'` 表示这个路由组的 url 前缀是 /admin，也就是说中间那一行代码 `Route::get('/'` 对应的链接不是 http://fuck.io:88/ 
//而是 http://fuck.io:88/admin ，如果这段代码是 `Route::get('fuck'` 的话，那么 URL 就应该是 http://fuck.io:88/admin/fuck 
//'namespace' => 'Admin'` 表示下面的 `AdminHomeController@index` 不是在 `\App\Http\Controllers\AdminHomeController@index` 
//而是在 `\App\Http\Controllers\Admin\AdminHomeController@index`，加上了一个命名空间的前缀。
//Route::Group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
//	Route::get('/', 'AdminHomeController@index');
//});