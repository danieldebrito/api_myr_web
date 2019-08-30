<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../composer/vendor/autoload.php';
require './AccesoDatos.php';

///////////////////   ENTITIES  ///////////
require './entities/articulo/articuloApi.php';
require './entities/aplicacion/aplicacionApi.php';
require './entities/art_mar_mod_mot/art_mar_mod_motApi.php';
require './entities/usuario/userApi.php';



$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->get("/", function() {
  echo "
  <p style='font-size:50px;'>Hola mundo desde api_meyro_web_test</p> 
  <br> <br> 
  <p style='font-family:courier;'>Conexion ok con la API.</p>
  ";
});

$app->group('/aplicaciones', function () {
  $this->get('/', \aplicacionApi::class . ':readAllApi');
  $this->get('/{id_aplicacion}', \aplicacionApi::class . ':readApi');
  $this->post('/', \aplicacionApi::class . ':createApi');
  $this->delete('/{id_aplicacion}[/]', \aplicacionApi::class . ':deleteApi');
  $this->post('/update', \aplicacionApi::class . ':updateApi');
});

$app->group('/articulos', function () {
  $this->get('/', \articuloApi::class . ':readAllApi');
  $this->get('/{id_articulo}', \articuloApi::class . ':readApi');
  $this->post('/', \articuloApi::class . ':createApi');
  $this->delete('/{id_articulo}[/]', \articuloApi::class . ':deleteApi');
  $this->post('/update', \articuloApi::class . ':updateApi');
});

$app->group('/art_mar_mod_mot', function () {
  $this->get('/', \art_mar_mod_motApi::class . ':readAllApi');
  $this->post('/filtrar[/]', \art_mar_mod_motApi::class . ':readParamsApi');
});


// http://localhost/api_meyro_web/index.php/user
$app->group('/user', function () {
  $this->get('/', \userApi::class . ':readAllApi');
  $this->get('/{id_user}', \userApi::class . ':readApi');
  $this->post('/', \userApi::class . ':createApi');
  $this->delete('/{id_user}[/]', \userApi::class . ':deleteApi');
  $this->post('/update', \userApi::class . ':updateApi');

  $this->post('/login[/]', \userApi::class . ':LoginUser');

  /*
    http://localhost/api_meyro/index.php/user/login

    body + raw  + 

    {
      "nombre":"ddebrito",
      "clave":"1388"
    }
  */

});

// cors habilitadas
$app->add(function ($req, $res, $next) {
  $response = $next($req, $res);
  return $response
          ->withHeader('Access-Control-Allow-Origin', 'http://localhost:4200')
          ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
          ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->run();