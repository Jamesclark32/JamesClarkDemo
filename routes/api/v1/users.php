<?php

Route::resource('users', 'UserController')
    ->only([
        'index',
        'show',
    ])
    ->parameters([
        'users' => 'placeholderUser',
    ]);
