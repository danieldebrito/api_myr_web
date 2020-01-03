<?php
require_once 'cliente.php';
require_once 'IApiCRUD.php';

class clienteApi extends cliente implements IApiCRUD {
	
	public function readAllApi($request, $response, $args) {
		$all=cliente::readAll();
	   	$response = $response->withJson($all, 200);  
		  
		return $response;
	}

	public function readApi($request, $response, $args) {
		$id=$args['id'];
		$art=cliente::read($id);
		$newResponse = $response->withJson($art, 200);  
		
		return $newResponse;
	}

	public function CreateApi($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();

	  	$entity = new cliente();
	  	$entity->idCliente = $ArrayDeParametros['idCliente'];
	  	$entity->cuit = $ArrayDeParametros['cuit'];
		$entity->razonSocial = $ArrayDeParametros['razonSocial'];
		$entity->condFiscal = $ArrayDeParametros['condFiscal'];
		$entity->retIIBBcoef = $ArrayDeParametros['retIIBBcoef'];
		$entity->idDescuento = $ArrayDeParametros['idDescuento'];
		$entity->userNombre = $ArrayDeParametros['userNombre'];
		$entity->email = $ArrayDeParametros['email'];
		$entity->clave = $ArrayDeParametros['clave'];
		$entity->estado = $ArrayDeParametros['estado'];
		  
		$response = $entity->create();

	  	return $response;
	}

	public function updateApi($request, $response, $args)
    {
		$ArrayDeParametros = $request->getParsedBody();
		
		$entity = new cliente();
		$entity->idCliente = $ArrayDeParametros['idCliente'];
		$entity->cuit = $ArrayDeParametros['cuit'];
	  	$entity->razonSocial = $ArrayDeParametros['razonSocial'];
	  	$entity->condFiscal = $ArrayDeParametros['condFiscal'];
	  	$entity->retIIBBcoef = $ArrayDeParametros['retIIBBcoef'];
	  	$entity->idDescuento = $ArrayDeParametros['idDescuento'];
	  	$entity->userNombre = $ArrayDeParametros['userNombre'];
	  	$entity->email = $ArrayDeParametros['email'];
	  	$entity->clave = $ArrayDeParametros['clave'];
	  	$entity->estado = $ArrayDeParametros['estado'];

		$resultado = $entity->update();
		
        $objDelaRespuesta = new stdclass();
		$objDelaRespuesta->resultado = $resultado;
		
        return $response->withJson($objDelaRespuesta, 200);
	}
	
	public function deleteApi($request, $response, $args){
        $id = $args["id"];
        $respuesta = cliente::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

	public function LoginCliente($request, $response, $args)
    {
        $json = $request->getBody();
		$data = json_decode($json, true);

		$retorno = cliente::Login($data["idCliente"], $data["clave"]);

        if ($retorno["idCliente"] != "") {
            $respuesta = array("Estado" => "OK", "Mensaje" => "Logueado Exitosamente", "id" => $retorno["id"]);
        } else {
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "Usuario o Clave Invalidos");
        }
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }   
}
?>




