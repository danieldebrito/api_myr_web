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

    public function CreateApi($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();

        $id_usuario = $ArrayDeParametros['id_usuario'];
        $nombre = $ArrayDeParametros['nombre'];
        $apellido = $ArrayDeParametros['apellido'];
        $usuario = $ArrayDeParametros['usuario'];
        $pass = $ArrayDeParametros['pass'];
        $estado = $ArrayDeParametros['estado'];
        $rol = $ArrayDeParametros['rol'];

        $entity = new producto();
        $entity->id_usuario = $id_usuario;
        $entity->nombre = $nombre;
        $entity->apellido = $apellido;
        $entity->usuario = $usuario;
        $entity->pass = $pass;
        $entity->estado = $estado;
        $entity->rol = $rol;

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
}
