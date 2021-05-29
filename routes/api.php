<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Language
    Route::apiResource('languages', 'LanguageApiController');

    // Author
    Route::apiResource('authors', 'AuthorApiController');

    // Aarshbook
    Route::apiResource('aarshbooks', 'AarshbookApiController');

    // Aarshgranth
    Route::apiResource('aarshgranths', 'AarshgranthApiController');

    // Aarshchapter
    Route::apiResource('aarshchapters', 'AarshchapterApiController');

    // Aarsh Desc
    Route::post('aarsh-descs/media', 'AarshDescApiController@storeMedia')->name('aarsh-descs.storeMedia');
    Route::apiResource('aarsh-descs', 'AarshDescApiController');
});
