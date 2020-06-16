<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//$router->get('search', 'SectionController@search');
$router->get('doctor/search', 'DoctorController@search');
$router->get('search', 'EstablishmentController@search');
$router->get('single-establishment', 'EstablishmentController@singleEstablishment');
$router->get('specialities', function() {
    return \App\Models\Speciality::all();
});
$router->get('sections', function() {
    return \App\Models\Section::all();
});
$router->get('a', 'SectionController@index');
