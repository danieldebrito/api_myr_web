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
require './entities/cliente/clienteApi.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->get("/", function() {
  echo "
  <p style='font-size:50px;'>Hola mundo desde api_meyro_web_test</p> 
  <br> <br> 
  <p style='font-family:courier;'>Conexion ok con la API.</p>

  http://localhost/api_myr_web/app/clientes/
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

$app->group('/user', function () {
  $this->get('/', \userApi::class . ':readAllApi');
  $this->get('/{id_user}', \userApi::class . ':readApi');
  $this->post('/', \userApi::class . ':createApi');
  $this->delete('/{id_user}[/]', \userApi::class . ':deleteApi');
  $this->post('/update', \userApi::class . ':updateApi');

  $this->post('/login[/]', \userApi::class . ':LoginUser');

  /*
    body + raw  + 

    {
      "userName":"ddebrito",
      "pass":"1388"
    }
  */

});

$app->group('/clientes', function () {
  $this->get('/', \clienteApi::class . ':readAllApi');
  $this->get('/{id}', \clienteApi::class . ':readApi');
  $this->post('/', \clienteApi::class . ':createApi');
  $this->delete('/{id}[/]', \clienteApi::class . ':deleteApi');
  $this->post('/update', \clienteApi::class . ':updateApi');

  $this->post('/login[/]', \clienteApi::class . ':LoginCliente');
});

$app->add(function ($req, $res, $next) {
  $response = $next($req, $res);
  return $response
          // ->withHeader('Access-Control-Allow-Origin', 'http://juntasmeyro.com.ar')
          ->withHeader('Access-Control-Allow-Origin', 'http://localhost:4200')
          ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
          ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->run();