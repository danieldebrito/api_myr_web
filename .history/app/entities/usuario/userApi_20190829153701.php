<?php
require_once 'user.php';

class userApi extends user {

	public function readAllApi($request, $response, $args){
        $all = user::readAll();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }

    public function readApi($request, $response, $args){
        $id = $args['id_user'];
        $Ret = user::read($id);
        $newResponse = $response->withJson($Ret, 200);
        return $newResponse;
    }

    public function CreateApi($request, $response, $args){
        $ArrayDeParametros = $request->getParsedBody();

        $id_producto = $ArrayDeParametros['id_producto'];
        $id_sector = $ArrayDeParametros['id_sector'];
        $producto = $ArrayDeParametros['producto'];
        $tiempo_preparacion = $ArrayDeParametros['tiempo_preparacion'];
        $precio = $ArrayDeParametros['precio'];

        $entity = new producto();
        $entity->id_producto = $id_producto;
        $entity->id_sector = $id_sector;
        $entity->producto = $producto;
        $entity->tiempo_preparacion = $tiempo_preparacion;
        $entity->precio = $precio;

        $entity->create();
        $response->getBody()->write("true");

        return $response;
    }

    public function deleteApi($request, $response, $args)
    {
        $id = $args["id_producto"];
        $respuesta = producto::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function updateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
        $entity = new producto();
        $entity->id_producto = $ArrayDeParametros['id_producto'];
        $entity->id_sector = $ArrayDeParametros['id_sector'];
        $entity->producto = $ArrayDeParametros['producto'];
        $entity->tiempo_preparacion = $ArrayDeParametros['tiempo_preparacion'];
        $entity->precio = $ArrayDeParametros['precio'];

        $resultado = $entity->update();
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->resultado = $resultado;
        return $response->withJson($objDelaRespuesta, 200);
    }


	/*
	
	public function TraerTodos($request, $response, $args) {
		$all=user::selectAll();
	   	$response = $response->withJson($all, 200);  
		  
		return $response;
	}

	public function TraerUno($request, $response, $args) {
		$id_usuario=$args['id'];
		$art=user::selectOne($id_usuario);
		$newResponse = $response->withJson($art, 200);  
		
		return $newResponse;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();

		$idUsuario= $ArrayDeParametros['idUsuario'];
		$nombre= $ArrayDeParametros['nombre'];
		$email= $ArrayDeParametros['email'];
		$clave= $ArrayDeParametros['clave'];
		$estado= $ArrayDeParametros['estado'];
		$rol= $ArrayDeParametros['rol'];

	  
	  	$miUser = new user();
	  	$miUser->idUsuario=$idUsuario;
	  	$miUser->nombre=$nombre;
		$miUser->email=$email;
		$miUser->clave=$clave;
		$miUser->estado=$estado;
		$miUser->rol=$rol;
		  
		  $miUser->setOne();
		  $response->getBody()->write("true");

	  	return $response;
	}

	public function LoginUser($request, $response, $args)
    {
        $json = $request->getBody();
		$data = json_decode($json, true);

		$retorno = user::Login($data["nombre"], $data["clave"]);

        if ($retorno["nombre"] != "") {
            $respuesta = array("Estado" => "ok", "Mensaje" => "Logueado Exitosamente", "idUsuario" => $retorno["idUsuario"]);
        } else {
            $respuesta = array("Estado" => "fail", "Mensaje" => "Usuario o Clave Invalidos");
        }
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }   */
}
?>




