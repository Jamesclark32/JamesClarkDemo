<?php

Route::resource('posts', 'PostController')
    ->only([
        'index',
    ])
    ->parameters([
        'posts' => 'placeholderComments',
    ]);
