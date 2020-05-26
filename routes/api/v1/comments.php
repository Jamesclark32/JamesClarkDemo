<?php

Route::resource('comments', 'CommentController')
    ->only([
        'index',
    ])
    ->parameters([
        'comments' => 'placeholderComments',
    ]);
