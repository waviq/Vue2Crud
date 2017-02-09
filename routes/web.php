<?php

Route::get('/','StudentController@index');
Route::get('api/student', 'StudentController@getData');
Route::post('api/student/saved', 'StudentController@simpan');
Route::delete('api/student/delete/{id}', 'StudentController@delete');
//Route::get('student/search/', 'StudentController@postSearch');

