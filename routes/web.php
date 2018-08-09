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

//Route::get('check_jquery_login','settings\Notifications@check_jquery_login')->name('checkJqueryLogin');
Route::group(['middleware'=>'auth'],function (){
    Route::get('/','DashboardController@index')->name('dashboard');
    Route::get('profile','ProfileController@index')->name('showProfile');
    Route::post('profile','ProfileController@update')->name('updateProfile');

    /**
     * settings
     */
    /*--------------------------|
    |       notifications       |
    |--------------------------*/
    Route::get('notifications','settings\Notifications@index')->name('Notifications');
    Route::get('notification_see','settings\Notifications@notification_see')->name('notification_see');
    //Route::get('get_total_new_notification','settings\Notifications@get_total_new_notification')->name('getTotalNewNotification');
    /*--------------------------|
    |       basic settings      |
    |--------------------------*/
    Route::get('setting/general','settings\SettingsController@index')->name('generalSettings');
    Route::post('setting/general','settings\SettingsController@store')->name('savegeneralSettings');
    /*--------------------------|
    |       branch setup        |
    |--------------------------*/
    Route::get('setting/branch','settings\BranchController@index')->name('allBranch');
    Route::get('setting/branch/datatable','settings\BranchController@datatable')->name('branchDataTable');
    Route::get('setting/branch/new','settings\BranchController@create')->name('newBranch');
    Route::post('setting/branch/new','settings\BranchController@store')->name('storeBranch');
    Route::get('setting/branch/edit/{id}','settings\BranchController@edit')->name('editBranch');
    Route::post('setting/branch/edit/{id}','settings\BranchController@update')->name('updateBranch');
    Route::get('setting/branch/shut_down/{id}','settings\BranchController@shut_down')->name('shutDownBranch');
    Route::get('setting/branch/reopen/{id}','settings\BranchController@reopen')->name('reopenBranch');

    /*--------------------------|
    |       users settings      |
    |--------------------------*/
    Route::get('setting/users','settings\UserController@index')->name('allUsersInfo');
    Route::get('setting/users/datatable','settings\UserController@datatable')->name('allUsersInfoDataTable');
    Route::get('setting/user/new','settings\UserController@create')->name('signUpForm');
    Route::post('setting/user/new','settings\UserController@store')->name('storeUserInfo');
    Route::get('setting/user/details/{id}','settings\UserController@show')->name('showUserInfo');
    Route::get('setting/user/block/{id}','settings\UserController@block')->name('blockUser');
    Route::get('setting/user/unblock/{id}','settings\UserController@unblock')->name('unblockUser');
    Route::get('setting/user/delete/{id}','settings\UserController@destroy')->name('deleteUser');
    Route::post('setting/user/resetUserPassword/{id}','settings\UserController@resetUserPassword')->name('resetUserPassword');
    /*--------------------------|
    |       activateUser        |
    |       need to work when   |
    |       software will live  |
    |--------------------------*/
    $this->get('verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');

    /*---------------------------|
    |       Product Settings     |
    |---------------------------*/
    $this->get('product/category', 'product\ProductCatSettingsController@index')->name('productCategory');
    $this->post('product/category', 'product\ProductCatSettingsController@store')->name('saveProductCategory');
    $this->get('product/category/datatable', 'product\ProductCatSettingsController@datatable')->name('productCategoryDataTable');
    $this->get('product/category/edit/{id}', 'product\ProductCatSettingsController@edit')->name('editProductCategory');
    $this->post('product/category/edit/{id}', 'product\ProductCatSettingsController@update')->name('updateProductCategory');
    $this->get('product/category/deactivate/{id}', 'product\ProductCatSettingsController@deactivate')->name('deactivateProductCategory');
    $this->get('product/category/reactive/{id}', 'product\ProductCatSettingsController@reactive')->name('reactiveProductCategory');
});

//dashboard
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
