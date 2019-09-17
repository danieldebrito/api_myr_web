<?php
require_once 'marca.php';
require_once 'IApiCRUD.php';

class marcaApi extends marca implements IApiCRUD {
	
	public function readAllApi($request, $response, $args) {
		$all=marca::readAll();
	   	$response = $response->withJson($all, 200);  
		  
		return $response;
	}

	public function readApi($request, $response, $args) {
		$id=$args['id'];
		$art=marca::read($id);
		$newResponse = $response->withJson($art, 200);  
		
		return $newResponse;
	}

	public function CreateApi($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();

		$entity = new marca();
		$entity->id_marca = $ArrayDeParametros['id_marca'];
		$entity->id_linea = $ArrayDeParametros['id_linea'];
		$entity->marca = $ArrayDeParametros['marca'];
		$entity->rotacion = $ArrayDeParametros['rotacion'];
		  
		$response = $entity->create();

	  	return $response;
	}

	public function updateApi($request, $response, $args)
    {
		$ArrayDeParametros = $request->getParsedBody();
		
		$entity = new marca();
		$entity->id_marca = $ArrayDeParametros['id_marca'];
		$entity->id_linea = $ArrayDeParametros['id_linea'];
		$entity->marca = $ArrayDeParametros['marca'];
		$entity->rotacion = $ArrayDeParametros['rotacion'];

		$resultado = $entity->update();
		
        $objDelaRespuesta = new stdclass();
		$objDelaRespuesta->resultado = $resultado;
		
        return $response->withJson($objDelaRespuesta, 200);
	}
	
	public function deleteApi($request, $response, $args){
        $id = $args["id"];
		$respuesta = marca::delete($id);
		
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
}
?>




