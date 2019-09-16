<?php
require_once 'producto.php';
require_once 'IApiCRUD.php';

class productoApi extends producto implements IApiCRUD {
	
	public function readAllApi($request, $response, $args) {
		$all=producto::readAll();
	   	$response = $response->withJson($all, 200);  
		  
		return $response;
	}

	public function readApi($request, $response, $args) {
		$id=$args['id'];
		$art=producto::read($id);
		$newResponse = $response->withJson($art, 200);  
		
		return $newResponse;
	}

	public function CreateApi($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();

		$entity = new producto();

	  	$entity->id_producto = $ArrayDeParametros['id_producto'];
		$entity->producto = $ArrayDeParametros['producto'];
		  
		$response = $entity->create();

	  	return $response;
	}

	public function updateApi($request, $response, $args)
    {
		$ArrayDeParametros = $request->getParsedBody();
		
		$entity = new producto();

	  	$entity->id_producto = $ArrayDeParametros['id_producto'];
		$entity->producto = $ArrayDeParametros['producto'];

		$resultado = $entity->update();
		
        $objDelaRespuesta = new stdclass();
		$objDelaRespuesta->resultado = $resultado;
		
        return $response->withJson($objDelaRespuesta, 200);
	}
	
	public function deleteApi($request, $response, $args){
        $id = $args["id"];
        $respuesta = producto::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
}
?>




