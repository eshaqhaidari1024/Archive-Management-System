<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Middleware\Admin;
Auth::routes();
Route::group(['middleware'=>'auth'],function (){

    Route::get('/', function () {
        return view('layout.home');
    });

Route::middleware([Admin::class])->group(function(){

    Route::group(['prefix' => 'home'], function () {

        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class,'index'])->name('home.list');
        Route::match(['get', 'post'], 'create', 'HomeController@create')->name('home.create');
        Route::match(['get', 'put'], 'update/{id}', 'CountryController@update');

    });

//user
 Route::group(['prefix' => 'user', 'namespace' => 'Admin'], function () {
        Route::get('/getUser/{id?}', [\App\Http\Controllers\Admin\UsersController::class,'index'])->name('user.list');
        Route::match(['get', 'post'], 'create', [\App\Http\Controllers\Admin\UsersController::class,'create'])->name('user.create');
        Route::match(['get', 'put'], 'update/{id}', [\App\Http\Controllers\Admin\UsersController::class,'update'])->name('user.update');
        Route::match(['get', 'put'], 'doLogout', [\App\Http\Controllers\Admin\UsersController::class,'doLogout'])->name('user.doLogout');
        Route::delete('delete/{id}', [\App\Http\Controllers\Admin\UsersController::class,'delete'])->name('user.delete');

        Route::get('userInfo/{id}', [\App\Http\Controllers\Admin\UsersController::class,'userInfo'])->name('user.userInfo');
        Route::match(['get', 'put'], 'editUserInfo/{id}', [\App\Http\Controllers\Admin\UsersController::class,'editUserInfo'])->name('user.editUserInfo');
        Route::match(['get', 'put'], 'editUserSecurity/{id}', [\App\Http\Controllers\Admin\UsersController::class,'editUserSecurity'])->name('user.editUserSecurity');

        Route::match(['get', 'put'], 'editUserPublicInfoUpdate/{id}', [\App\Http\Controllers\Admin\UsersController::class,'editUserPublicInfo'])->name('user.editUserPublicInfoUpdate');
        Route::match(['get', 'put'], 'editUserSecurityInfoUpdate/{id}', [\App\Http\Controllers\Admin\UsersController::class,'editUserSecurityInfo'])->name('user.editUserSecurityInfoUpdate');

        Route::match(['get', 'post'], 'search/{id}', [\App\Http\Controllers\Admin\UsersController::class,'search'])->name('user.search');
        Route::get('changeStatus', [\App\Http\Controllers\Admin\UsersController::class,'changeStatus'])->name('user.changeStatus');
        Route::get('changeBranches', [\App\Http\Controllers\Admin\UsersController::class,'changeBranches'])->name('user.changeBranches');
    });

//company routes
    Route::group(['prefix' => 'letter', 'namespace' => 'Admin'], function () {

        Route::get('/list/{id?}',[\App\Http\Controllers\Admin\CreateLetter::class,'index'])->name('letter.list');
        Route::match(['get', 'post'], 'create',[\App\Http\Controllers\Admin\CreateLetter::class,'create'])->name('letter.create');
        Route::match(['get','put'],'update/{id}',[\App\Http\Controllers\Admin\CreateLetter::class,'update'])->name('letter.update');
        Route::delete('/delete/{i}',[\App\Http\Controllers\Admin\CreateLetter::class,'delete'])->name('letter.delete');
        Route::get('/single/{id}',[\App\Http\Controllers\Admin\CreateLetter::class,'singleLetter'])->name('letter.single');
        Route::post('/removeImage',[\App\Http\Controllers\Admin\CreateLetter::class,'removeImage'])->name('letter.removeImage');
        Route::get('/search/{id}',[\App\Http\Controllers\Admin\CreateLetter::class,'search'])->name('letter.search');
        Route::get('/searchDep',[\App\Http\Controllers\Admin\CreateLetter::class,'getData'])->name('letter.data');
        Route::get('/download/{id}',[\App\Http\Controllers\Admin\CreateLetter::class,'getDownload'])->name('letter.download');
        Route::get('/report',[\App\Http\Controllers\Admin\CreateLetter::class,'report'])->name('letter.report');
        Route::get('/getReport/{id?}',[\App\Http\Controllers\Admin\CreateLetter::class,'getReport'])->name('letter.get_report');
        Route::get('/displayImage/{filename}',[\App\Http\Controllers\Admin\CreateLetter::class,'displayImage'])->name('letter.display.image');
        Route::get('/export',[\App\Http\Controllers\Admin\CreateLetter::class,'export'])->name('letter.export');
        Route::post('/import',[\App\Http\Controllers\Admin\CreateLetter::class,'import'])->name('letter.import');
    });
    /*Create Department*/
    Route::group(['prefix' => 'dep', 'namespace' => 'Admin'], function () {

        Route::get('/list/{id?}',[\App\Http\Controllers\Admin\ArchDepartment::class,'index'])->name('dep.list');
        Route::match(['get', 'post'], 'create', [\App\Http\Controllers\Admin\ArchDepartment::class,'create'])->name('dep.create');
        Route::match(['get','put'],'update/{id}',[\App\Http\Controllers\Admin\ArchDepartment::class,'update'])->name('dep.update');
        Route::delete('/delete/{id}',[\App\Http\Controllers\Admin\ArchDepartment::class,'delete'])->name('dep.delete');


    });

    /*backup route*/
    Route::group(['prefix' => 'backup', 'namespace' => 'Admin'], function () {

        Route::get('/', [\App\Http\Controllers\Admin\BackupController::class,'index'])->name('backup.index');
        Route::get('/create', [\App\Http\Controllers\Admin\BackupController::class,'create'])->name('backup.create');
        Route::get('/download/{file_name}', [\App\Http\Controllers\Admin\BackupController::class,'download'])->name('backup.download');
        Route::delete('/delete', [\App\Http\Controllers\Admin\BackupController::class,'delete'])->name('backup.delete');
        Route::get('/getBackup', [\App\Http\Controllers\Admin\BackupController::class,'getBackup'])->name('backup.getBackup');
    });

});

});



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//home

