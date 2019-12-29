<?php
require_once 'expreso.php';
require_once 'IApiCRUD.php';

class expresoApi extends expreso implements IApiCRUD {
	
	public function readAllApi($request, $response, $args) {
		$all=expreso::readAll();
	   	$response = $response->withJson($all, 200);  
		  
		return $response;
	}

	public function readApi($request, $response, $args) {
		$id=$args['id'];
		$art=expreso::read($id);
		$newResponse = $response->withJson($art, 200);  
		
		return $newResponse;
	}

	public function CreateApi($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();

	  	$entity = new expreso();
	  	$entity->id_expreso = $ArrayDeParametros['id_expreso'];
	  	$entity->id_direccion = $ArrayDeParametros['id_direccion'];
		$entity->nombre = $ArrayDeParametros['nombre'];
		  
		$response = $entity->create();

	  	return $response;
	}

	public function updateApi($request, $response, $args)
    {
		$ArrayDeParametros = $request->getParsedBody();
		
		$entity = new expreso();
		
		$entity->id_expreso = $ArrayDeParametros['id_expreso'];
		$entity->id_direccion = $ArrayDeParametros['id_direccion'];
	  	$entity->nombre = $ArrayDeParametros['nombre'];

		$resultado = $entity->update();
		
        $objDelaRespuesta = new stdclass();
		$objDelaRespuesta->resultado = $resultado;
		
        return $response->withJson($objDelaRespuesta, 200);
	}
	
	public function deleteApi($request, $response, $args){
        $id = $args["id"];
        $respuesta = expreso::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
	}
	
	public function readByNameApi($request, $response, $args) {
		$name=$args['name'];
		$item=expreso::readByName($name);
		$newResponse = $response->withJson($item, 200);  
		
		return $newResponse;
	}
}
?>




