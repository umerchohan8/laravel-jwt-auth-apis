<?php

Route::post('login', 'AuthController@login');

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    // House
    Route::post('addHouse', 'HouseController@addHouse');
    Route::patch('updateHouse/{id}', 'HouseController@updateHouse');
    Route::delete('deleteHouse/{id}', 'HouseController@deleteHouse');
    Route::get('getMyHouses', 'HouseController@getMyHouses');
    Route::get('getUserHouses/{user_id}', 'HouseController@getUserHouses');
});