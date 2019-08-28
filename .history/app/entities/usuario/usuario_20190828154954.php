<?php
class usuario{
    public $id_usuario;
    public $nombre;
    public $apellido;
    public $usuario;
    public $password;
    public $estado;  // { activo, inactivo, suspendido }
    public $rol; // { admin, user_sistema, user_web, supervisor }

    public static function readAll(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
                "SELECT * 
                FROM `usuarios` 
                WHERE 1   
			");
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
            $ret = $mensaje;
        } finally {
            return $ret;
        }
    }

    public static function read($id_usuario){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
            "SELECT * 
            FROM `usuarios`
			WHERE `id_usuario` = '$id_usuario'
			");
            $consulta->execute();
            $ret = $consulta->fetchObject('usuario');
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public function create(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta(
                "INSERT INTO `usuarios` 
                (`id_usuario`, `nombre`, `apellido`, `usuario`, `pass`, `estado`, `rol`)
			VALUES 
                ( :id_usuario, :nombre, :apellido, :usuario, :pass, :estado, :rol)
		    ");

            $consulta->bindValue(':id_usuario', $this->id_producto, PDO::PARAM_STR);
            $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
            $consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_INT);
            $consulta->bindValue(':pass', $this->pass, PDO::PARAM_INT);
            $consulta->bindValue(':estado', $this->estado, PDO::PARAM_INT);
            $consulta->bindValue(':rol', $this->rol, PDO::PARAM_INT);

            $consulta->execute();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $this->id_producto();
        }
    }

    public function update(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
                UPDATE `usuarios` 
                SET 
				`nombre`=:nombre, 
                `apellido`=:apellido, 
                `usuario`=:usuario, 
                `pass`=:pass,
                `estado`=:estado,
                `rol`=:rol
                WHERE id_usuario=:id_usuario");   
                
                $consulta->bindValue(':id_usuario', $this->id_usuario, PDO::PARAM_STR);
                $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
                $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
                $consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_INT);
                $consulta->bindValue(':pass', $this->pass, PDO::PARAM_INT);
                $consulta->bindValue(':estado', $this->estado, PDO::PARAM_INT);
                $consulta->bindValue(':rol', $this->rol, PDO::PARAM_INT);
        
        return $consulta->execute();
    }

    public static function delete($id_usuario){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
                DELETE FROM `usuarios` 
                WHERE `id_usuario` = '$id_usuario'
            ");
            $consulta->bindValue(':id_usuario', $id_usuario, PDO::PARAM_STR);
            $consulta->execute();
            $respuesta = array("Estado" => true, "Mensaje" => "Eliminado Correctamente");

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => false, "Mensaje" => "$mensaje");

        } finally {
            return $respuesta;
        }
    }
}
