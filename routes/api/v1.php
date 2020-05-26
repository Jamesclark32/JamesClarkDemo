<?php
Route::namespace('v1')->name('v1.')->prefix('v1')->group(function () {
    include 'v1/users.php';
    include 'v1/posts.php';
    include 'v1/comments.php';
});
