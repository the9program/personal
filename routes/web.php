<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Authentication
// todo: register with real
Auth::routes(['verify' => true]);

// security

Route::namespace('Auth')
    ->prefix('security')
    ->middleware('auth')
    ->group(function (){

        Route::get('/', 'SecurityController@security')
            ->name('security');

        Route::post('/', 'SecurityController@email')
            ->name('security.email');

        Route::put('/', 'SecurityController@password')
            ->name('security.password');

    });

// todo: real [Params - Address - Phones - Profile - Register]

Route::namespace('Personal')
    ->middleware('auth')
    ->group(function (){

        // params

        Route::prefix('params')->group(function (){

            Route::get('/','ParamsController@paramsForm')->name('params');
            Route::post('/','ParamsController@params');

        });

        // address

        Route::prefix('address')->group(function (){
            Route::get('/','AddressController@index')->name('address.index');
            Route::post('/','AddressController@store')->name('address.store');
            Route::put('/{address}','AddressController@update')->name('address.update');
            Route::delete('/{address}','AddressController@destroy')->name('address.destroy');
            Route::patch('/{address}','AddressController@primary')->name('address.default');
        });

        // address

        Route::prefix('mobile')->group(function (){
            Route::get('/','MobileController@index')->name('mobile.index');
            Route::post('/','MobileController@store')->name('mobile.store');
            Route::put('/{phone}','MobileController@update')->name('mobile.update');
            Route::delete('/{phone}','MobileController@destroy')->name('mobile.destroy');
            Route::patch('/{phone}','MobileController@primary')->name('mobile.default');
        });

        Route::get('profile','RealController@profil')->name('profile');

    });
// todo: Admin [list Admins - show - create - MailToken - RegisterAdmin - updateRoles - delete]
// todo: Admin [list users - delete]

// Blog home

Route::get('/', function () {
    return view('welcome');
});

// dashboard

Route::get('/home', 'HomeController@index')->name('home');

// language

Route::post('language/', [
    'before' => 'csrf',
    'as' => 'language-chooser',
    'uses' => 'LanguageController@changeLanguage'
]);
