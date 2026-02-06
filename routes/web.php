<?php
use App\User;
use App\Notifications\userNotification ;


Route::get('/', function () {
    if(auth()->check()){return Redirect::to('home');}
    return view('auth/login');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/projet/create', 'projetController@create')->name('projet.create');
Route::get('/projet/voirprojet/{id}', 'projetController@voirProjet')->name('projet.voirprojet');
//
Route::post('/projet/store', 'projetController@store')->name('projet.store');
Route::post('/projet/projetsWilaya', 'projetController@projetsWilaya')->name('projet.projetsWilaya');

Route::get('/projet/gestionprojets/{id}/{finance}/{year}', 'projetController@gestion')->name('projet.gestionprojets');
Route::post('/projet/update/{projet}', 'projetController@update')->name('projet.update');
Route::get('/projet/destroy/{projet}', 'projetController@destroy')->name('projet.destroy');
Route::get('/projet/getInfoByNature/{nature}', 'projetController@getInfoByNature')->name('projet.getInfoByNature');
Route::get('/projet/recaps/{recap_id}/{finance}/{year}', 'projetController@recaps')->name('projet.recaps');
Route::get('/projet/recaps/{recap_id}/{finance}/{year}', 'projetController@recaps')->name('projet.recaps');
Route::get('/projet/recap4/{nature}/{year}', 'projetController@recap4SelecteNature')->name('projet.recap4');

Route::get('/home/{wilaya_id}/', 'HomeController@canvasW')->name('projet.canvasW');
Route::get('/projet/deleteA/{avancement}/{projet}', 'projetController@deleteA')->name('projet.deleteA');
Route::get('/projet/notifications','projetController@notifications')->name('projet.notifications');
Route::get('/projet/markAsReadNotif/{id}','projetController@markAsReadNotif')->name('projet.markAsReadNotif');
Route::post('/projet/markAsRead','projetController@markAsRead')->name('projet.markAsRead');
Route::post('/projet/deleteNotif','projetController@deleteNotif')->name('projet.deleteNotif');


Route::get('/projet/{id}/retards','projetController@indexRetards')->name('projet.indexRetards');
Route::post('/projet/{id}/storeRetard','projetController@storeRetard')->name('projet.storeRetard');
Route::get('/projet/destroyRetard/{id}','projetController@destroyRetard')->name('projet.destroyRetard');
Route::post('/projet/updateRetard/{id}','projetController@updateRetard')->name('projet.updateRetard');



Route::post('admin/user/restPass', 'Admin\UserPassRestController@Update')->name('user.changePassword');


Route::get('admin/users/{user}','Admin\UsersController@show')->name('admin.users.show');
Route::get('/annuaire','Admin\UsersController@annuaire')->name('annuaire');
Route::post('/changeTel','Admin\UsersController@changeTel')->name('changeTel');
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users','UsersController',['except'=>['show','create','store']]);

});

Route::resource('/images','ImageController');


Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){

    Route::resource('/finances','FinancesController');
});
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){

    Route::resource('/natures','NaturesController');
});
