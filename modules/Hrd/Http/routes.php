<?php

Route::group(['prefix' => 'hrd', 'namespace' => 'Modules\Hrd\Http\Controllers', 'middleware' => 'hrd'], function()
{
	Route::get('/', 'HrdController@index');
    Route::get('/stakeholder/search', 'StakeholderController@search');

	Route::post('indicator/create-indicator' ,'IndicatorController@createIndicator');
	Route::post('indicator/create-performance' ,'IndicatorController@postCreatePerformance');

	Route::resource('indicator' ,'IndicatorController');
	Route::resource('/stakeholder', 'StakeholderController');
	Route::resource('/division', 'DivisionController');
	Route::resource('/report' ,'ReportController');
	Route::resource('/performance' ,'PerformanceController');
	Route::resource('/vacation' ,'VacationController');
	Route::resource('/position' ,'PositionController');
	Route::resource('/golongan' ,'GolonganController');
	Route::resource('/config' ,'ConfigController');

});