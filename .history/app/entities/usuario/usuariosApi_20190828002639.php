<?php
require_once 'usuarios.php';
require_once 'IApiCRUD.php';

class usuarioApi extends usuario implements IApiCRUD
{
    public function readAllApi($request, $response, $args)
    {
        $all = usuario::readAll();
        $newResponse = $response->withJson($all, 200);
        return $newResponse;
    }

    public function readApi($request, $response, $args)
    {
        $id = $args['id_usuario'];
        $Ret = usuario::read($id);
        $newResponse = $response->withJson($Ret, 200);
        return $newResponse;
    }

    public function CreateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();

        $entity = new usuario();
        $entity->id_usuario = $ArrayDeParametros['id_usuario'];
        $entity->nombre = $ArrayDeParametros['nombre'];
        $entity->apellido = $ArrayDeParametros['apellido'];
        $entity->usuario = $ArrayDeParametros['usuario'];
        $entity->pass = $ArrayDeParametros['pass'];
        $entity->estado = $ArrayDeParametros['estado'];
        $entity->rol = $ArrayDeParametros['rol'];

        $entity->create();
        $response->getBody()->write("true");

        return $response;
    }

    public function updateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();

        $entity = new usuario();
        $entity->id_usuario = $ArrayDeParametros['id_usuario'];
        $entity->nombre = $ArrayDeParametros['nombre'];
        $entity->apellido = $ArrayDeParametros['apellido'];
        $entity->usuario = $ArrayDeParametros['usuario'];
        $entity->pass = $ArrayDeParametros['pass'];
        $entity->estado = $ArrayDeParametros['estado'];
        $entity->rol = $ArrayDeParametros['rol'];

        $resultado = $entity->update();
        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->resultado = $resultado;
        return $response->withJson($objDelaRespuesta, 200);
    }

    public function deleteApi($request, $response, $args)
    {
        $id = $args["id_usuario"];
        $respuesta = producto::delete($id);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }
}

    /*
        usuario
        usuarios

        id_usuario;
        nombre;
        apellido;
        usuario;
        pass;
        estado;
        rol;
    */

