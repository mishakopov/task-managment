<?php
return[
    'login' => 'Controllers\AuthController@loginView',
    'register' => 'Controllers\AuthController@registerView',
    'user/register' => 'Controllers\AuthController@register',
    'user/logout' => 'Controllers\UserController@logout',
    'user/login' => 'Controllers\AuthController@login',
    'user/edit' => 'Controllers\UserController@edit',
    'user/update' => 'Controllers\UserController@update',
    '/' => "Controllers\HomeController@index",
    'task/all' => "Controllers\TaskController@all",
    'task/create' => "Controllers\TaskController@create",
    'task/store' => "Controllers\TaskController@store",
    'task/change-status/{id}' => "Controllers\TaskController@changeStatus"

];
