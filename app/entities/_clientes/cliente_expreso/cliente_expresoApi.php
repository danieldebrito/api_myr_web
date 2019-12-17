<?php
require_once 'cliente_expreso.php';
require_once 'IApiCRUD.php';

class cliente_expresoApi extends cliente_expreso implements IApiCRUD {
	
	public function readAllApi($request, $response, $args) {
		$all=cliente_expreso::readAll();
	   	$response = $response->withJson($all, 200);  
		  
		return $response;
	}

	public function readApi($request, $response, $args) {
		$id=$args['id'];
		$art=cliente_expreso::read($id);
		$newResponse = $response->withJson($art, 200);  
		
		return $newResponse;
	}

	public function CreateApi($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();

	  	$entity = new cliente_expreso();
	  	$entity->idCliente = $ArrayDeParametros['idCliente'];
		$entity->idExpreso = $ArrayDeParametros['idExpreso'];
		  
		$response = $entity->create();

	  	return $response;
	}

	public function updateApi($request, $response, $args)
    {
		$ArrayDeParametros = $request->getParsedBody();
		
		$entity = new cliente_expreso();
		
		$entity->idClienteExpreso = $ArrayDeParametros['idClienteExpreso'];
		$entity->idCliente = $ArrayDeParametros['idCliente'];
	  	$entity->idExpreso = $ArrayDeParametros['idExpreso'];

		$resultado = $entity->update();
		
        $objDelaRespuesta = new stdclass();
		$objDelaRespuesta->resultado = $resultado;
		
        return $response->withJson($objDelaRespuesta, 200);
	}
	
	public function deleteApi($request, $response, $args){
        $id = $args["id"];
        $respuesta = cliente_expreso::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
}
?>




