<?php

/** @var \Laravel\Lumen\Routing\Router $router */
 
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

//composer create-project --prefer-dist laravel/lumen blog
//php -S localhost:8000 -t public
// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

//jwt token start 
//-> composer require tymon/jwt-auth
//-> AppServiceProvider -> $this->app->register(\Tymon\JWTAuth\Providers\LumenServiceProvider::class);
//-> php artisan jwt:secret
//-> modyfy this file -> C:\xampp\htdocs\lumen\myclasses\vendor\laravel\lumen-framework\config\auth.php 
// create user model
// create user controller  

//add php command start
//1-> composer require flipbox/lumen-generator
//2-> $app->register(Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class);


//add php Unit 
//1-> sudo apt-get install phpunit
//2-> php artisan make:test AppTest --unit 

//add session 
// https://stackoverflow.com/questions/47050984/enabling-session-in-lumen-framework
//1-> https://stackoverflow.com/questions/47050984/enabling-session-in-lumen-framework
//2-> composer require illuminate/session
//3-> https://github.com/laravel/laravel/blob/8.x/config/session.php
//4-> create folder config-> create file session.php
//5-> 
 
 
//excel export 
//https://docs.laravel-excel.com/3.1/getting-started/installation.html
//https://www.youtube.com/watch?v=xuqBZYTvAVg
//composer require maatwebsite/excel
//php artisan make:export OrdersExport 

//import excel
//php artisan make:import UsersImport

$router->get('/', 'ExampleController@Myfirstfunction');
$router->get('/all-products', [ 'as' => 'all-products', 'uses' => 'ExampleController@AllProducts']);
$router->get('/export-all-products', [ 'as' => 'export-all-products', 'uses' => 'ExampleController@ExportAllProducts']);
$router->post('/import-products', [ 'as' => 'import-products', 'uses' => 'ExampleController@ImportProducts']);
$router->get('/session', 'ExampleController@mysessiondata');
  
$router->group(['prefix' => '/user','middleware' => 'MyMiddleware'], function () use ($router) {
    $router->get('/', 'ExampleController@HelloWorld');
    $router->get('/profile', 'ExampleController@HelloWorld');
});  

$router->post('/login', 'ExampleController@postLogin');
 
$router->group(['prefix' => '/','middleware' => 'auth'], function () use ($router){
    $router->get('test', 'ExampleController@test');
    $router->get('allusers', 'ExampleController@GetUser');
 
    $router->get('orders-list', 'OrdersController@list');
    $router->post('new-order', 'OrdersController@neworder');
});
$router->group(['middleware' => 'throttle:5,1'], function () use ($router) {
    $router->get('test-throttle', 'OrdersController@Forthrottle');
    $router->post('test-throttle', 'OrdersController@Forthrottle');
});
