<?php
class usuario{
    public $id_usuario;
    public $nombre;
    public $apellido;
    public $usuario;
    public $pass;
    public $estado;  // { activo, inactivo, suspendido }
    public $rol; // { admin, user_sistema, user_web, supervisor }

    public static function readAll(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT * FROM `mesas` WHERE 1   
			");
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS, "mesa");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public static function read($id_mesa){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			SELECT *
			FROM `mesas`
			WHERE `id_mesa` = '$id_mesa'
			");
            $consulta->execute();
            $ret = $consulta->fetchObject('mesa');
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public function create()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
			INSERT INTO `mesas`
				(`id_mesa`,
				`id_estado_mesa`,
				`url_foto`,
                `cant_comensales`)
			VALUES (
				:id_mesa,
				:id_estado_mesa,
				:url_foto,
                :cant_comensales)
		");

            $consulta->bindValue(':id_mesa', $this->id_mesa, PDO::PARAM_STR);
            $consulta->bindValue(':id_estado_mesa', $this->id_estado_mesa, PDO::PARAM_STR);
            $consulta->bindValue(':url_foto', $this->url_foto, PDO::PARAM_STR);
            $consulta->bindValue(':cant_comensales', $this->cant_comensales, PDO::PARAM_INT);

            $consulta->execute();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
    }

    public static function delete($id_mesa){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta("
                DELETE FROM `mesas` 
                WHERE `id_mesa` = '$id_mesa'
            ");
            $consulta->bindValue(':id_mesa', $id_mesa, PDO::PARAM_STR);
            $consulta->execute();
            $respuesta = array("Estado" => true, "Mensaje" => "Eliminado Correctamente");

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => false, "Mensaje" => "$mensaje");

        } finally {
            return $respuesta;
        }
    }

    public function update()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
                UPDATE `mesas` 
                SET 
				`id_estado_mesa`=:id_estado_mesa, 
				`url_foto`=:url_foto, 
                `cant_comensales`=:cant_comensales
                WHERE id_mesa=:id_mesa");
                
                $consulta->bindValue(':id_mesa', $this->id_mesa, PDO::PARAM_STR);
                $consulta->bindValue(':id_estado_mesa', $this->id_estado_mesa, PDO::PARAM_STR);
                $consulta->bindValue(':url_foto', $this->url_foto, PDO::PARAM_STR);
                $consulta->bindValue(':cant_comensales', $this->cant_comensales, PDO::PARAM_INT);
        
        return $consulta->execute();
    }
}
