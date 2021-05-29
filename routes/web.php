<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Language
    Route::delete('languages/destroy', 'LanguageController@massDestroy')->name('languages.massDestroy');
    Route::resource('languages', 'LanguageController');

    // Author
    Route::delete('authors/destroy', 'AuthorController@massDestroy')->name('authors.massDestroy');
    Route::resource('authors', 'AuthorController');

    // Aarshbook
    Route::delete('aarshbooks/destroy', 'AarshbookController@massDestroy')->name('aarshbooks.massDestroy');
    Route::resource('aarshbooks', 'AarshbookController');

    // Aarshgranth
    Route::delete('aarshgranths/destroy', 'AarshgranthController@massDestroy')->name('aarshgranths.massDestroy');
    Route::resource('aarshgranths', 'AarshgranthController');

    // Aarshchapter
    Route::delete('aarshchapters/destroy', 'AarshchapterController@massDestroy')->name('aarshchapters.massDestroy');
    Route::resource('aarshchapters', 'AarshchapterController');

    // Aarsh Desc
    Route::delete('aarsh-descs/destroy', 'AarshDescController@massDestroy')->name('aarsh-descs.massDestroy');
    Route::post('aarsh-descs/media', 'AarshDescController@storeMedia')->name('aarsh-descs.storeMedia');
    Route::post('aarsh-descs/ckmedia', 'AarshDescController@storeCKEditorImages')->name('aarsh-descs.storeCKEditorImages');
    Route::resource('aarsh-descs', 'AarshDescController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
