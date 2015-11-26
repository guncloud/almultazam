<?php

Route::get('/', ['middleware' => 'auth', function(){
	$module = (Auth::user()->is('hrd')) ? 'hrd' : 'siswa';
    return redirect('/'.$module);
}]);

Route::get('/home', ['middleware' => 'auth', function(){
    $module = (Auth::user()->is('hrd')) ? 'hrd' : 'siswa';
    return redirect('/'.$module);
}]);

Route::resource('/user', 'UserController');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'tool' => 'ToolController',
    'admin' => 'RootController'
]);
