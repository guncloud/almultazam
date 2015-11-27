<?php

Route::get('/', ['middleware' => 'auth', function(){
    $role = Auth::user()->roles[0]->name;

    if($role == 'root'){
        $page = 'admin';
    }elseif($role == 'pembina' || $role == 'admin' || $role == 'guru' || $role == 'alquran'){
        $page = 'siswa';
    }elseif($role == 'hrd'){
        $page = 'hrd';
    }else{
        $page = 'error';
    }

    return redirect('/'.$page);
}]);

Route::get('/home', ['middleware' => 'auth', function(){
    $role = Auth::user()->roles[0]->name;

    if($role == 'root'){
        $page = 'admin';
    }elseif($role == 'pembina' || $role == 'admin' || $role == 'guru' || $role == 'alquran'){
        $page = 'siswa';
    }elseif($role == 'hrd'){
        $page = 'hrd';
    }else{
        $page = 'error';
    }

    return redirect('/'.$page);
}]);

Route::resource('/user', 'UserController');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'tool' => 'ToolController',
    'admin' => 'RootController'
]);
