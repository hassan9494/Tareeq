<?php

use App\Admin;
use Illuminate\Support\Facades\Route;

// Route::get('/home', function () {
//     $users[] = Auth::user();
//     $users[] = Auth::guard()->user();
//     $users[] = Auth::guard('admin')->user();

//     //dd($users);

//     return view('admin.home');
// })->name('home');
Route::get('/home', 'Admin\HomeController@index')->name('home');
Route::prefix('roles')->group(function () {

    Route::group(['middleware' => ['permission:read role']], function () {
        Route::get('all', 'Admin\RolesController@index')->name('role.all');
    });
    Route::group(['middleware' => ['permission:create role']], function () {
        Route::get('create', 'Admin\RolesController@create')->name('role.create');
        Route::post('create', 'Admin\RolesController@store')->name('role.store');
    });
    Route::group(['middleware' => ['permission:update role']], function () {
        Route::get('edit/{role}', 'Admin\RolesController@edit')->name('role.edit');
        Route::post('edit/{role}', 'Admin\RolesController@update')->name('role.update');
    });
    Route::group(['middleware' => ['permission:delete role']], function () {
        Route::get('delete/{role}', 'Admin\RolesController@destroy')->name('role.destroy');
    });
});
Route::group(['prefix'=>'users'],function () {

    Route::group(['middleware' => ['permission:read user']], function () {
        Route::get('all', 'Admin\UsersController@index')->name('users.all');
    });
    Route::group(['middleware' => ['permission:create user']], function () {
        Route::get('create', 'Admin\UsersController@create')->name('users.create');
        Route::post('create', 'Admin\UsersController@store')->name('users.store');
    });
    Route::group(['middleware' => ['permission:update user']], function () {
        Route::get('edit/{user}', 'Admin\UsersController@edit')->name('users.edit');
        Route::post('edit/{user}', 'Admin\UsersController@update')->name('users.update');
    });
    Route::group(['middleware' => ['permission:delete user']], function () {
        Route::get('delete/{user}', 'Admin\UsersController@destroy')->name('users.destroy');
    });
});

Route::group(['middleware' => ['permission:control testmonial section']], function () {

    Route::resource('testmonials', 'Admin\TestmonialController');
    Route::get('/testmonial/{id}', 'Admin\TestmonialController@destroy')->name('testmonial.destroy');
    Route::get('/testmonialSetting', 'Admin\TestmonialController@setting')->name('setting');

});


Route::group(['middleware' => ['permission:control aboutUs section']], function () {
    Route::get('/aboutUs', 'Admin\SectionsController@about')->name('aboutUs');
});
Route::get('freetrial', 'Admin\SectionsController@freetrial');

Route::group(['middleware' => ['permission:edit sections setting|control aboutUs section']], function () {
    Route::put('/section/setting', 'Admin\SectionsController@update')->name('section.setting.update');
    Route::post('/serviceMainDescription', 'Admin\SectionsController@updateMainDesc')->name('updateMainDesc');
});
Route::group(['middleware' => ['permission:control partners section']], function () {
    Route::get('partners', 'Admin\PartnersController@partners')->name('partners');
    Route::post('partners', 'Admin\PartnersController@store')->name('partners.store');
    Route::post('partnersLogo', 'Admin\PartnersController@storeLogo')->name('partners.storeLogo');
    Route::get('partnersLogo', 'Admin\PartnersController@logo');
    Route::get('images', 'Admin\PartnersController@showImages');
    Route::get('deleteLogo/{image}', 'Admin\PartnersController@delete')->name('deleteLogo');
    Route::get('deleteBackground/{image}', 'Admin\PartnersController@deleteBackground')->name('deleteBackground');
    Route::put('updateLogo/{image}','Admin\PartnersController@update')->name('updateLogo');
});


Route::get('profile','Admin\SettingsController@editProfile')->name('profile.edit');
Route::post('updateProfile','Admin\SettingsController@updateProfile')->name('profile.update');




/************** feature route ***************/
Route::group(['middleware' => ['permission:control feature section']], function () {
    Route::resource('/feature', 'Admin\FeatureController');
    Route::get('/feature/{feature}', 'Admin\FeatureController@destroy')->name('feature.destroy');
    Route::get('/featureSetting', 'Admin\FeatureController@featureSetting');
});
/************** end feature route ***************/
/************** packages route ***************/
Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('/package', 'Admin\PackageController');
    Route::get('/packages/{package}', 'Admin\PackageController@destroy')->name('package.destroy');
    Route::post('/packageTime', 'Admin\PackageController@packageTime')->name('packageTime.store');
});
/************** end feature route ***************/

/********** product *********/
//Route::group(['middleware' => ['permission:control products section']], function () {
    Route::resource('courses', 'Admin\ProductsController');
    Route::get('/courses/{id}/delete', 'Admin\ProductsController@destroy')->name('product.destroy');
    Route::get('deleteImage/{media}','Admin\ProductsController@deleteImage')->name('product.deleteImage');

//});

///********** classes *********/
//Route::group(['middleware' => ['permission:control products section']], function () {
    Route::resource('classes', 'Admin\CoursesController');
    Route::get('/classes/{id}/delete', 'Admin\CoursesController@destroy')->name('courses.destroy');
    Route::post('/lesson/{lesson}', 'Admin\CoursesController@updateLesson')->name('lesson.update');
    Route::post('AddLesson', 'Admin\CoursesController@store_lesson')->name('lesson.AddLesson');
    Route::get('/lesson/{lesson}/{status}', 'Admin\CoursesController@changeStatus')->name('lesson.status.change');

//});

Route::group(['middleware' => ['permission:control productCategory section']], function () {
    Route::resource('categoryProduct', 'Admin\CategoryProductController');
    Route::get('/catProduct/{id}', 'Admin\CategoryProductController@destroy')->name('catProduct.destroy');
    Route::get('productSetting','Admin\CategoryProductController@setting');
    Route::get('categories/subCategory/{category}','Admin\CategoryProductController@subCategory');
    Route::get('categories/attributes/{category}','Admin\CategoryProductController@attributes');

});
Route::group(['middleware' => ['permission:approve product']], function () {
    Route::post('product/status/{product}', 'Admin\ProductsController@status')->name('product.status');
});

/*********************end products ************/


/*** end events ***/
Route::group(['middleware' => ['permission:control slider section']], function () {
    Route::resource('slider', 'Admin\SliderController');
    Route::get('deleteSlider/{slider}', 'Admin\SliderController@destroy')->name('slider.delete');
});
/* pages */

/* end pages*/
Route::group(['middleware' => ['permission:update website settings']], function () {
    Route::get('settings', 'Admin\SettingsController@edit')->name('settings.edit');
    Route::put('/settings', 'Admin\SettingsController@update')->name('settings.update');
});
//gallery

// blog category

/********** themes ***********/
Route::group(['middleware' => ['permission:control themes section']], function () {
    Route::get('themes', 'Admin\ThemesController@index')->name('themes');
    Route::get('activeTheme/{active}', 'Admin\ThemesController@active')->name('activeTheme');
    Route::post('visible', 'Admin\ThemesController@visible')->name('visible');

});
/****** end themes ***********/
/*** teams ***/
Route::group(['middleware' => ['permission:control team section']], function () {

    Route::resource('teams', 'Admin\TeamsController');
    Route::get('/team/{id}', 'Admin\TeamsController@destroy')->name('team.destroy');
    Route::get('/teamSetting', 'Admin\TeamsController@setting')->name('setting');

});
/*** end teams  ***/
/* teacher */
Route::group(['middleware' => ['permission:control teacher section']], function () {
    Route::get('teachers', 'Admin\UsersController@allUsers')->name('teachers');
    Route::get('/review/{user}', 'Admin\UsersController@review')->name('approve.review');
    Route::get('/show/{user}', 'Admin\UsersController@show')->name('showHome.show');
    Route::get('teacher/{user}','Admin\UsersController@editUser')->name('teacher.edit');
    Route::post('edit/{user}', 'Admin\UsersController@updateTeacher')->name('teacher.update');
    Route::get('teacher/pay/{user}', 'Admin\UsersController@payToTeacher')->name('teacher.paid');
    Route::get('teacher/show/{user}', 'Admin\UsersController@showTeacher')->name('teacher.show');
    Route::get('siteUser/delete/{user}', 'Admin\UsersController@deleteUser')->name('site.user.delete');
    Route::get('siteUser/shiftDelete/{user}', 'Admin\UsersController@shiftDelete')->name('site.user.shiftDelete');
    Route::get('siteUser/recover/{user}', 'Admin\UsersController@recoverUser')->name('site.user.recover');


});
/* student*/
Route::group(['middleware' => ['permission:control student section']], function () {
    Route::get('students', 'Admin\UsersController@allstudent');
//    Route::get('/review/{user}', 'Admin\UsersController@review')->name('approve.review');
    Route::get('student/show/{user}', 'Admin\UsersController@showStudent')->name('student.show');
    Route::get('student/edit/{user}', 'Admin\UsersController@editStudent')->name('student.edit');
    Route::post('student/update/{user}', 'Admin\UsersController@updateStudent')->name('student.update');

});
/* order and request */
Route::get('orders','Admin\OrderController@index')->name('orders');
Route::get('orders/review/{order}','Admin\OrderController@review')->name('orders.review');
Route::get('orders/{order}/{status}', 'Admin\OrderController@update')->name('orders.update');
Route::get('order_delete/{order}', 'Admin\OrderController@delete')->name('orders.delete');

Route::get('requests','Admin\RequestsController@service')->name('requests');
Route::get('requestsPage','Admin\RequestsController@page')->name('requestsPage');
/*contact us */
Route::get('message','Admin\MessagesController@index')->name('message');
Route::get('jobs','Admin\MessagesController@jobs')->name('jobs');


/* media */
Route::get('media','Admin\mediaController@index')->name('media');
Route::post('mediaUpload','Admin\mediaController@store')->name('mediaUpload');
Route::get('mediaDelete/{media}','Admin\mediaController@destroy')->name('mediaDelete');

//accounting
Route::prefix('voucher')->group(function () {
    Route::group(['middleware' => ['permission:read voucher']], function () {
        Route::get('all', 'Admin\VoucherController@index')->name('voucher.all');
        Route::post('all', 'Admin\VoucherController@index')->name('voucher.filter');
        Route::get('categories', 'VoucherCategoriesController@index')->name('voucher.category.all');
    });
    Route::group(['middleware' => ['permission:create voucher']], function () {
        Route::get('create', 'VoucherController@create')->name('voucher.create');
        Route::post('create', 'Admin\VoucherController@store')->name('voucher.store');

        Route::post('category/create', 'VoucherCategoriesController@store')->name('voucher.category.store');
        Route::post('category/{category}', 'VoucherCategoriesController@update')->name('voucher.category.update');
    });
    Route::group(['middleware' => ['permission:read voucher']], function () {
        Route::get('{voucher}', 'VoucherController@show')->name('voucher.show');
    });

    Route::prefix('income')->group(function () {
        Route::group(['middleware' => ['permission:read voucher']], function () {
            Route::get('all', 'Admin\VoucherController@income')->name('voucher.income.all');
            Route::post('all', 'Admin\VoucherController@income')->name('voucher.income.filter');
        });
    });
});
