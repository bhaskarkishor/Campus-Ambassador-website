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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

Route::get('/home',function(){ return redirect('/dashboard'); });


Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

Route::group(['prefix' => 'dashboard'], function () {
    Voyager::routes();
});

Route::group(['prefix' => 'dashboard','middleware'=>'auth'], function () {
    //Route::get('','ProfileController@dashboard');
    Route::get('leaderboard','HomeController@leaderboard');
    Route::get('contactus','ContactUSController@contactUS');
    Route::post('contactus', ['as'=>'contactus.store','uses'=>'ContactUSController@contactUSPost']);
    Route::get('shareDetails',function(){return view('dashboard.shareDetails');});
    Route::get('guidlines',function(){return view('dashboard.guidlines');});
    Route::get('fb','pointcontroller@posts');
    Route::get('idea',function(){return view('dashboard.idea');});
    Route::post('/increase/{post}','pointcontroller@index');
    Route::get('editinfo','HomeController@editpage');
    Route::post('editinfo','HomeController@storedata');
    Route::get('edit',function(){return view('dashboard.info');});
});

