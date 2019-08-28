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
            $consulta = $objetoAccesoDato->RetornarConsulta("
			INSERT INTO `productos`
				(`id_producto`,
				`id_sector`,
				`producto`,
				`tiempo_preparacion`,
                `precio`)
			VALUES (
				:id_producto,
				:id_sector,
				:producto,
				:tiempo_preparacion,
                :precio)
		");

            $consulta->bindValue(':id_producto', $this->id_producto, PDO::PARAM_STR);
            $consulta->bindValue(':id_sector', $this->id_sector, PDO::PARAM_STR);
            $consulta->bindValue(':producto', $this->producto, PDO::PARAM_STR);
            $consulta->bindValue(':tiempo_preparacion', $this->tiempo_preparacion, PDO::PARAM_INT);
            $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);

            $consulta->execute();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
    }

    
    /*
        usuario
        usuarios
        id_usuario;
        nombre;
        apellido;
        usuario;
        password;
        estado;
        rol;
    */

    public function update(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
                UPDATE `productos` 
                SET 
				`id_sector`=:id_sector, 
                `producto`=:producto, 
                `tiempo_preparacion`=:tiempo_preparacion, 
                `precio`=:precio
                WHERE id_producto=:id_producto");
                
                $consulta->bindValue(':id_producto', $this->id_producto, PDO::PARAM_STR);
                $consulta->bindValue(':id_sector', $this->id_sector, PDO::PARAM_STR);
                $consulta->bindValue(':producto', $this->producto, PDO::PARAM_STR);
                $consulta->bindValue(':tiempo_preparacion', $this->tiempo_preparacion, PDO::PARAM_INT);
                $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
        
        return $consulta->execute();
    }

    public static function delete($id_producto){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
                DELETE FROM `productos` 
                WHERE `id_producto` = '$id_producto'
            ");
            $consulta->bindValue(':id_producto', $id_producto, PDO::PARAM_STR);
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
