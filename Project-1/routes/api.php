<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




################       users      ###########################


Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);

Route::post('confirm-Code',[UserController::class,'confirmCode']);
Route::post('forget-password',[UserController::class,'forgetPassword_SendEmail']);
Route::post('set-new-password',[UserController::class,'forgetPassword_SetPassword']);


Route::group(['middleware'=>['auth:sanctum']], function () {
    /*
    Route::get('check', function () {
        return response()->json([ 
            'Message'=> 'Check',
        ],200);
    });
    */

    Route::get('logout',[UserController::class,'logout']);
    Route::get('profile',[UserController::class,'profile']);
    Route::post('change-profile-photo',[UserController::class,'changeProfilePhoto']);

    //put api in postman
    Route::post('change-name',[UserController::class,'changeName']);

    

});


################       Admin      ###########################

Route::post('admin-login',[AdminController::class,'login']);

Route::group(['middleware'=>['auth:sanctum','role:Super Admin|Admin']],function(){

        Route::controller(AdminController::class)->group(function () {

            Route::post('add-admin','addAdmin');
            Route::get('admin-profile','profile');
            Route::get('admin-logout','logout');
            Route::post('change-profile-photo','changeProfilePhoto');
            Route::get('get-all-admin','getAllAdmin');
            Route::get('get-admin/{id}','getAdmin');
            Route::get('get-admis-for-role/{id}','getAdmisForRole');

                 //put api in postman
            Route::post('change-name','changeName');
        });


    Route::controller(RoleController::class)->group(function () {
        Route::get('get-all-roles','getAllRoles');
        Route::get('get-all-permission','getAllPermission');
        Route::get('get-all-permission-for-role/{id}','getAllPermissionForRole');
        Route::post('add-role','addRole');
    });
////////////////////////////new of mohammad//////////////////

   

});



Route::get('/index', [RoleController::class, 'index']);
Route::get('/index2', [RoleController::class, 'index2']);
Route::get('/create', [RoleController::class, 'create']);
Route::get('/book', [RoleController::class, 'book']);
Route::post('/setRole', [RoleController::class, 'setRole']);










//////////////////////////////////////mohammad_Leader//////////////////





// Route::get('get_all_category',[CategoryController::class,'index']);
// Route::get('get_all_area',[AreaController::class,'index']);


// Route::post('store_category',[CategoryController::class,'store']);
//Route::post('store_area',[AreaController::class,'store']);

//Route::get('get_all_country',[CountryController::class,'index']);
//Route::post('store_country',[CountryController::class,'store']);
//Route::get('show_country/{id}',[CountryController::class,'show']);
Route::controller(CountryController::class)->group(function(){
    Route::post('store_country','store');
    Route::get('show_country/{id}','show');
    Route::get('get_all_country','index');
    Route::post('update_country/{id}','update');
    Route::get('delete_country/{id}','destroy');
    
    
    
    
});



Route::controller(CategoryController::class)->group(function(){
    Route::post('store_category','store');
    Route::get('get_all_category','index');
    Route::get('show_category/{id}','show');
    Route::post('update_category/{id}','update');
    Route::get('delete_category/{id}','destroy');
   
    
});



Route::controller(AreaController::class)->group(function(){
   Route::post('store_area','store'); 
   Route::get('get_all_area','index');
   Route::get('show_area/{id}','show');
   Route::post('update_area/{id}','update');
   Route::get('delete_area/{id}','destroy');
});