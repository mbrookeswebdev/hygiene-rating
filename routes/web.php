<?php

Route::get('/', function () {
    return view('hr');
});

Route::get('/query', 'QueryController@query');
