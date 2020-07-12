<?php


Route::middleware(['web'])->namespace('Tymr\Plugins\Contact\Controllers')->group( function() {

	
	Route::get('/Contact', 'ContactController@index')->name('app.contact.show');

	Route::post('/Contact',  'ContactController@sendContactRequest')->name('app.contact.post');



