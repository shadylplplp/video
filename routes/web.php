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

Route::post('/senddanmu','DanmuController@create');
Route::get('/getdanmu/{id}','DanmuController@get');
Route::get('/', 'VideoController@index')->name('home');
Route::get('/videolist/{video_type}','VideoController@showvideolist')->name('videolist');
Route::get('/video/{id}/','VideoController@showvideo')->name('video.show');
Route::get('/user/{id}/','UserController@showuser')->name('user.showusercennter');
Route::get('/user/comments/{id}','CommentController@showcomments')->name('user.comments');
Route::get('/user/mycomments/{id}','UserController@showusercentcomments')->name('user.usercentercomments');
Route::post('/user/comments/create/','CommentController@createcomment')->name('user.createcomment');
Route::get('/maopao','VideoController@maopao');
Route::get('/kuaisu','VideoController@kuaisuf');

//关注
Route::get('/follow/check/{id}','UserController@checkfollow')->name('follow.check');
Route::get('/follow/{id}','UserController@follow')->name('follow.check');
Route::get('/myfollow/','UserController@myfocous')->name('follow.show');
Auth::routes();


Route::get('/usercenter','UserController@show')->name('user.show');
Route::get('/usercenter/contribute','VideoController@showcreate')->name('user.contribute');
Route::post('/usercenter/contribute','VideoController@create');

Route::get('/usercenter/useredit','UserController@edit')->name('user.edit');
Route::post('/usercenter/useredit','UserController@update')->name('user.update');
//自己写的改密码
Route::get('/usercenter/passwordedit','UserController@passwordedit')->name('user.passwordeditaaa');
Route::post('/usercenter/passwordedit','UserController@passwordupdate')->name('user.passwordedit');
//原生的改密码
Route::get('/resetpassword','Auth\ResetPasswordController@showResetForm');
Route::post('/resetpassword','Auth\ResetPasswordController@resetPassword');

Route::get('/usercenter/myfocus','UserController@showmyfocus')->name('user.myfocus');
Route::get('/usercenter/myfans','UserController@showmyfans')->name('user.myfans');

Route::get('/usercenter/videolist/','UserController@showvideolist')->name('user.showvideolist');
Route::get('/usercenter/editorvideo/{id}','VideoController@showeditvideo')->name('user.showeditvideo');
Route::get('/usercenter/deletevideo/{id}','VideoController@deletevideo')->name('user.deletevideo');
Route::post('/usercenter/editorvideo','VideoController@ditvideo')->name('user.editvideo');


Route::get('/usercenter/message','UserController@showmessageslist')->name('user.messagelist');

Route::post('/usercenter/message','MessagesController@sendmessage')->name('user.sendmessage');
Route::get('/usercenter/message/{id}','MessagesController@showmessages')->name('user.message');



//信息通知
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

// Email 认证相关路由
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');