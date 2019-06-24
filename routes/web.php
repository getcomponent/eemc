<?php

Route::get('/theory', 'DocController@theory');
Route::get('/practice', 'DocController@practice');
Route::get('/supporting', 'DocController@supporting');
Route::get('/tests', 'TestController@index');
Route::post('/tests/{path}/result', 'TestController@result')->where('path', '[0-9_A-Za-z-]+');
Route::get('/tests/{path}', 'TestController@test')->where('path', '[0-9_A-Za-z-]+');

Route::get('/admin', 'AdminController@index');
Route::get('/admin/users', 'AdminController@users');
Route::get('/admin/theory', 'AdminController@theory');
Route::get('/admin/tests', 'AdminController@tests');
Route::any('/admin/tests/add', 'AdminController@addTest');
Route::post('/admin/delete_user/{id}', 'AdminController@deleteUser')->where('id', '[0-9-]+');
Route::post('/admin/add_user', 'AdminController@addUser');
Route::post('/admin/delete_doc/{id}', 'AdminController@deleteDoc')->where('id', '[0-9-]+');
Route::post('/admin/delete_test/{id}', 'AdminController@deleteTest')->where('id', '[0-9-]+');
Route::post('/admin/change_doc/{id}', 'AdminController@changeDoc')->where('id', '[0-9-]+');
Route::post('/admin/change_user/{id}', 'AdminController@changeUser')->where('id', '[0-9-]+');
Route::post('/admin/open_doc/{id}', 'AdminController@openDoc')->where('id', '[0-9-]+');
Route::post('/admin/open_user/{id}', 'AdminController@openUser')->where('id', '[0-9-]+');
Route::post('/admin/add_doc', 'AdminController@addDoc');
Route::post('/admin/view_tests/{id}', 'AdminController@viewTests')->where('id', '[0-9-]+');

Auth::routes();

Route::get('/', 'HomeController@index')->name('homes');
Route::get('flags/destroy/{delete}', 'FlagsController@destroy')->name('admin.flags.destroy');
