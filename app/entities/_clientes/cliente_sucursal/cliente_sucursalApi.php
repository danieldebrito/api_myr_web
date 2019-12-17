<?php
require_once 'cliente_sucursal.php';
require_once 'IApiCRUD.php';

class cliente_sucursalApi extends cliente_sucursal implements IApiCRUD {
	
	public function readAllApi($request, $response, $args) {
		$all=cliente_sucursal::readAll();
	   	$response = $response->withJson($all, 200);  
		  
		return $response;
	}

	public function readApi($request, $response, $args) {
		$id=$args['id'];
		$art=cliente_sucursal::read($id);
		$newResponse = $response->withJson($art, 200);  
		
		return $newResponse;
	}

	public function CreateApi($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();

	  	$entity = new cliente_sucursal();
	  	// $entity->id_sucursal = $ArrayDeParametros['id_sucursal'];  AI
	  	$entity->idCliente = $ArrayDeParametros['idCliente'];
		$entity->idClienteExpreso = $ArrayDeParametros['idClienteExpreso'];
		$entity->nombreSucursal = $ArrayDeParametros['nombreSucursal'];
		$entity->calle = $ArrayDeParametros['calle'];
		$entity->numero = $ArrayDeParametros['numero'];
		$entity->cp = $ArrayDeParametros['cp'];
		$entity->localidad = $ArrayDeParametros['localidad'];
		$entity->provincia = $ArrayDeParametros['provincia'];
		  
		$response = $entity->create();

	  	return $response;
	}

	public function updateApi($request, $response, $args)
    {
		$ArrayDeParametros = $request->getParsedBody();
		
		$entity = new cliente_sucursal();
		
		$entity->idSucursal = $ArrayDeParametros['idSucursal'];
		$entity->idCliente = $ArrayDeParametros['idCliente'];
		$entity->idClienteExpreso = $ArrayDeParametros['idClienteExpreso'];
		$entity->nombreSucursal = $ArrayDeParametros['nombreSucursal'];
	  	$entity->calle = $ArrayDeParametros['calle'];
	  	$entity->numero = $ArrayDeParametros['numero'];
	  	$entity->cp = $ArrayDeParametros['cp'];
	  	$entity->localidad = $ArrayDeParametros['localidad'];
	  	$entity->provincia = $ArrayDeParametros['provincia'];

		$resultado = $entity->update();
		
        $objDelaRespuesta = new stdclass();
		$objDelaRespuesta->resultado = $resultado;
		
        return $response->withJson($objDelaRespuesta, 200);
	}
	
	public function deleteApi($request, $response, $args){
        $id = $args["id"];
        $respuesta = cliente_sucursal::delete($id);
		$newResponse = $response->withJson($respuesta, 200);
		
        return $newResponse;
	}
	
	public function readAllClienteApi($request, $response, $args) {
		$id = $args['id'];
		$all=cliente_sucursal::readAllCliente($id);
	   	$response = $response->withJson($all, 200);  
		  
		return $response;
	}
}
?>




