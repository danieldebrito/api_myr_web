<?php
require_once 'user.php';

class userApi extends user {


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




