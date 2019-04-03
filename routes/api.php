<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/question','QuestionController');
Route::apiResource('/category','CategoryController');
Route::apiResource('/question/{question}/reply','ReplyController');

Route::post('/like/{reply}','LikeController@LiketIt');
Route::delete('/like/{reply}','LikeController@unLiketIt');

Route::post('notifications','NotificationController@index');
//Route::post('notifications',function(){
//    return [
//        'read' => auth()->user()->readNotifications(),
//        'unread'=>auth()->user()->unreadNotifications,
//        'unreadCount'=>auth()->user()->unreadNotifications()->count(),
//
//    ];
//});
Route::post('markAsRead','NotificationController@markAsRead');
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('signup', 'AuthController@signup');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('payload', 'AuthController@payload');




});