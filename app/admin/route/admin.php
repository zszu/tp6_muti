<?php

use think\facade\Route;


Route::get('hello','Index/hello');
Route::get('index','Index/index');
Route::get('welcome','Index/welcome');
Route::post('login', 'User/login');
Route::get('logout', 'User/logout');
//Route::group(function (){
//
//})->middleware(function ($request , \Closure $next){
//    if(!session('username')){
//        return redirect('login');
//    }
//    return $next($request);
//});

//登录模块路由
//Route::group(function () {
//    Route::get('login', 'User/login')->middleware(function ($request, Closure $next) {
//        if (session('?username')) {
//            return redirect('/');
//        }
//        return $next($request);
//    });
//    Route::post('login', 'User/login');
//    Route::get('logout', 'User/logout');
//});

