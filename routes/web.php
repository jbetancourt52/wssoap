<?php

use App\Http\Controllers\CountryInfoController;
use App\Http\Controllers\CustomSoapController;


Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::get('/country-name/{code}', [CountryInfoController::class, 'getCountryName']);
Route::get('/list-of-country-names', [CountryInfoController::class, 'getListOfCountryNames']);
Route::post('/add-country', [CountryInfoController::class, 'addCountry']);

Route::post('/custom-soap', [CustomSoapController::class, 'handle']);
//prueba de git 
