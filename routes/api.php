<?php

Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
    
    Route::post('register','RegisterController@register');
    // Route::post('register_admin','RegisterController@register_admin');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
    Route::post('payload', 'AuthController@payload');

    Route::post('forgot-password-email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::post('forgot-password-reset', 'ResetPasswordController@reset');
});

//middleware(['auth:api'])
Route::middleware(['auth:api'])->group(function () {
    // Email Verification Routes...
    Route::post('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::post('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    //  Rutas de negocio
});

Route::group(['namespace' => 'Profile','prefix'=>'profile'], function () {
    // Current user
    Route::group(['prefix' => 'current', 'middleware' => ['auth:api']], function () {
        Route::post('set-password', 'ProfileController@setPassword');
    });
});

Route::group(['namespace' => 'Api'], function () {
    
    Route::middleware(['auth:api'])->group(function () {

    Route::resource('business', 'BusinessController');
    Route::resource('branch', 'BranchController');
    Route::resource('role', 'RoleController');
    Route::resource('user', 'UserController');
    Route::get('index', 'HomeController@index')->name('home.api');

    });
});


//llenar filtro routes
Route::group(['namespace' => 'Api\Support'], function() {
    // Route::get('/listColores', 'ColorController')->name('listColores.api');
    // Route::get('/listCategorias', 'CarCategoryController')->name('listCategorias.api');
    // Route::get('/listAnno', 'AnnoController')->name('listAnno.api');
    // Route::get('/listCategoriasVenta', 'CategorySalesController')->name('listCategoriasVenta.api');
    // Route::get('/listTipoTransmision', 'TrasmisionTypeController')->name('listTipoTransmision.api');
    // Route::get('/listTiposCombustibles', 'FuelTypeController')->name('listTiposCombustibles.api');
    // Route::get('/listPaises', 'CountryController')->name('listPaises.api');
    // Route::get('/listMarcas', 'BranchController')->name('listMarcas.api');
    // Route::get('/listEstadosTerritoriales/{id?}', 'TerritorialStateController')->name('listEstadosTerritoriales.api');
    // Route::get('/listModelosAutos/{id?}', 'CarModelController')->name('listModelosAutos.api');
    // Route::get('/listVersionesAutos', 'AutoVersionController')->name('listVersionesAutos.api');  
});
